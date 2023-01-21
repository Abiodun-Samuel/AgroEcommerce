<template>
  <Head title="Category" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <FormError :errors="form.errors" />

      <div class="row">
        <div class="col-lg-12">
          <div class="category mb-2">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button
                    class="
                      accordion-button
                      collapsed
                      fw-bolder
                      text-light
                      shadow-sm
                      bg-success
                    "
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne"
                    aria-expanded="false"
                    aria-controls="flush-collapseOne"
                  >
                    <Icon
                      icon="eos-icons:content-new"
                      class="me-1 text-light"
                      height="20"
                    />
                    Category
                  </button>
                </h2>
                <div
                  id="flush-collapseOne"
                  class="accordion-collapse collapse show"
                  aria-labelledby="flush-headingOne"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body p-1">
                    <div class="row">
                      <div class="my-1 col-lg-6 col-md-6">
                        <label for="category_title" class="form-label"
                          >Category Title</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="category_title"
                          placeholder="category"
                          v-model="form.category_title"
                        />
                      </div>
                      <div class="my-1 col-lg-6 col-md-6">
                        <div>
                          <label for="category_image" class="form-label"
                            >Category Image</label
                          >
                          <input
                            type="file"
                            class="form-control"
                            id="category_image"
                            accept=".jpg, .jpeg, .png"
                            @change="getFile($event)"
                          />
                        </div>
                        <div class="img_container mt-1" v-if="fileSrc">
                          <img
                            :src="fileSrc"
                            alt="category preview"
                            width="100"
                          />
                          <button @click="removeFile">
                            <Icon
                              color="text-danger"
                              icon="material-symbols:edit"
                              height="15"
                            />
                          </button>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <button
                          :disabled="
                            form.processing ||
                            !form.category_img ||
                            !form.category_title
                          "
                          @click="saveCategory"
                          class="btn btn-success"
                        >
                          <span>Save</span>
                          <span
                            v-if="form.processing"
                            class="spinner-border spinner-border-sm mx-1"
                            role="status"
                            aria-hidden="true"
                          ></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="category__table mt-2">
            <div class="table-responsive" v-if="categories.length">
              <table class="table table-hover table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(category, index) in categories"
                    :key="category.id"
                  >
                    <th scope="row">{{ index + 1 }}</th>
                    <td scope="row">{{ category.id.substring(0, 7) }}...</td>
                    <td>
                      <img
                        width="40"
                        :src="JSON.parse(category.banner_img)?.img_url"
                        alt="category image"
                      />
                    </td>
                    <td>{{ category.title }}</td>
                    <td
                      class="
                        d-flex
                        gap-2
                        justify-content-start
                        align-items-center
                      "
                    >
                      <Link
                        :href="route('admin.category.edit', category.id)"
                        class="btn btn-success btn-sm"
                      >
                        <Icon
                          icon="material-symbols:edit-square-outline"
                          height="17"
                        />
                      </Link>
                      <button
                        @click="
                          showDeleteCategoryModal = true;
                          formDelete.id = category.id;
                        "
                        class="btn btn-danger btn-sm"
                      >
                        <Icon icon="ic:outline-delete-forever" height="17" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div v-else class="text-center">
              <NoResult text="No categories found" :link="false" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>

  <Modal
    :show="showDeleteCategoryModal"
    :size="'modal-sm'"
    :footer="true"
    @close="showDeleteCategoryModal = false"
  >
    <template #header>
      <h4
        class="
          modal-title
          text-warning
          d-flex
          align-items-center
          gap-1
          fw-bolder
        "
      >
        <Icon icon="icon-park-outline:caution" />
        Caution
      </h4>
    </template>

    <template #body>
      <h5 class="fw-bold text-secondary">
        All Subcategories and Products attached to this category will also be
        deleted.
      </h5>
      <p class="text-danger">Are you sure you want to delete this category?</p>
    </template>

    <template #footer>
      <div class="d-flex gap-1 align-items-center">
        <!-- :disabled="formDelete.processing" -->
        <button @click="deleteCategory" class="btn btn-sm btn-danger">
          <span>Yes, Delete</span>
          <span
            v-if="formDelete.processing"
            class="spinner-border spinner-border-sm mx-1"
            role="status"
            aria-hidden="true"
          ></span>
        </button>
        <button
          @click="showDeleteCategoryModal = false"
          class="btn btn-sm btn-success"
        >
          No, Cancel
        </button>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import FormError from "@/Components/Common/FormError.vue";
import NoResult from "@/Components/Common/NoResult.vue";
import category_img from "@/assets/images/icons/subcategory.png";
import Modal from "@/Components/Common/Modal.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";

const props = defineProps(["categories"]);

let fileSrc = ref(null);
const showDeleteCategoryModal = ref(false);
const form = useForm({
  category_img: null,
  category_title: null,
  folder: "category",
});
const formDelete = useForm({
  id: null,
});
const step_one = {
  slug: "Category",
  link: false,
  route_name: null,
};

function getFile(e) {
  const fileList = (form.category_img = e.target.files[0]);
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}
function removeFile() {
  const fileList = document.getElementById("category_image");
  fileList.value = null;
  fileSrc.value = null;
}

const deleteCategory = () => {
  formDelete.delete(route("admin.category.destroy", formDelete.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Category has been deleted successfully");
      formDelete.reset();
      showDeleteCategoryModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to delete this category`);
    },
  });
};

const saveCategory = () => {
  form.clearErrors();
  const file = document.getElementById("category_image");
  form.post(route("admin.category.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("New category has been saved successfully");
      form.reset();
      file.value = null;
      fileSrc.value = null;
    },
    onError: () => {
      toast.error(`Unable to save new category`);
    },
  });
};
</script>

<style lang="css" scoped>
.img_container {
  width: 100px;
  position: relative;
}
.img_container button {
  position: absolute;
  top: -5px;
  right: -11px;
  background: #f6f5f5;
  padding: 2px;
  border-radius: 3px;
  color: red;
}
</style>