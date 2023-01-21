<template>
  <Head title="SubCategory" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <FormError :errors="form.errors" />

      <div class="row">
        <div class="col-lg-12 mb-2">
          <div class="category">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button
                    class="
                      accordion-button
                      collapsed
                      fw-bolder
                      bg-success
                      text-light
                      shadow-sm
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
                    Subcategory
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
                      <div class="my-1 col-lg-4 col-md-6">
                        <label for="category_image" class="form-label"
                          >Categories</label
                        >
                        <select
                          class="form-select"
                          aria-label="Default select example"
                          v-model="form.category_id"
                        >
                          <option selected disabled>Select Category</option>
                          <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                          >
                            {{ category.title }}
                          </option>
                        </select>
                      </div>

                      <div class="my-1 col-lg-4 col-md-6">
                        <label for="category_title" class="form-label"
                          >Subcategory Title</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="category_title"
                          placeholder="subcategory"
                          v-model="form.subcategory_title"
                        />
                      </div>
                      <div class="my-1 col-lg-4 col-md-6">
                        <label for="category_image" class="form-label"
                          >Subcategory Image</label
                        >
                        <input
                          type="file"
                          class="form-control"
                          id="subcategory_image"
                          @change="getFile($event)"
                          accept=".jpg, .jpeg, .png"
                        />
                        <div class="mt-1">
                          <div
                            class="img_container position-relative"
                            v-if="fileSrc"
                          >
                            <img
                              :src="fileSrc"
                              alt="product preview"
                              width="100"
                              class="rounded shadow-sm"
                            />
                            <button class="" @click="deleteImage">
                              <Icon
                                color="text-danger"
                                icon="material-symbols:edit"
                                height="15"
                              />
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button
                      :disabled="
                        form.processing ||
                        !form.subcategory_img ||
                        !form.category_id ||
                        !form.subcategory_title
                      "
                      @click="saveSubcategory"
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

        <div class="col-lg-12 mt-1">
          <div class="category__table">
            <div class="table-responsive" v-if="subcategories.length">
              <table class="table table-hover table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Subcategory Title</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(subcategory, index) in subcategories"
                    :key="subcategory.id"
                  >
                    <th scope="row">{{ index + 1 }}</th>
                    <td scope="row">{{ subcategory.id.substring(0, 7) }}...</td>
                    <td>
                      <img
                        :src="JSON.parse(subcategory.banner_img)?.img_url"
                        width="40"
                        alt="sub category image"
                      />
                    </td>
                    <td>{{ subcategory.category.title }}</td>
                    <td>{{ subcategory.title }}</td>
                    <td
                      class="
                        d-flex
                        gap-2
                        justify-content-start
                        align-items-center
                      "
                    >
                      <Link
                        :href="route('admin.subcategory.edit', subcategory.id)"
                        class="btn btn-success btn-sm"
                      >
                        <Icon
                          icon="material-symbols:edit-square-outline"
                          height="17"
                        />
                      </Link>
                      <button
                        @click="deleteSubcategory(subcategory.id)"
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
              <NoResult text="No SubCategories found" :link="false" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>

  <Modal
    :show="showDeleteSubcategoryModal"
    :size="'modal-sm'"
    :footer="true"
    @close="showDeleteSubcategoryModal = false"
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
        All Products attached to this subcategory will also be deleted.
      </h5>
      <p class="text-danger">Do you want to delete this subcategory?</p>
    </template>

    <template #footer>
      <div class="d-flex gap-1 align-items-center">
        <!-- :disabled="formDelete.processing" -->
        <button @click="deleteAction" class="btn btn-sm btn-danger">
          <span>Yes, Delete</span>
          <span
            v-if="formDelete.processing"
            class="spinner-border spinner-border-sm mx-1"
            role="status"
            aria-hidden="true"
          ></span>
        </button>
        <button
          @click="showDeleteSubcategoryModal = false"
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
import NoResult from "@/Components/Common/NoResult.vue";
import category_img from "@/assets/images/icons/subcategory.png";
import Modal from "@/Components/Common/Modal.vue";
import FormError from "@/Components/Common/FormError.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import { toast } from "@/utils/helper";

defineProps(["subcategories", "categories"]);

const showDeleteSubcategoryModal = ref(false);
const fileSrc = ref(null);
const formDelete = useForm({
  id: null,
});

const form = useForm({
  subcategory_img: null,
  subcategory_title: null,
  category_id: null,
  folder: "subcategory",
});

const step_one = {
  slug: "Subcategory",
  link: false,
  route_name: null,
};

const deleteSubcategory = (id) => {
  showDeleteSubcategoryModal.value = true;
  formDelete.id = id;
};

const deleteAction = () => {
  formDelete.delete(route("admin.subcategory.destroy", formDelete.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Subcategory has been deleted successfully");
      formDelete.reset();
      showDeleteSubcategoryModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to save subcategory`);
    },
  });
};

function deleteImage() {
  const fileList = document.getElementById("subcategory_image");
  fileList.value = null;
  fileSrc.value = null;
  form.subcategory_img = null;
}

function getFile(e) {
  const fileList = e.target.files[0];
  form.subcategory_img = fileList;
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}

const saveSubcategory = () => {
  form.clearErrors();
  const fileList = document.getElementById("subcategory_image");
  form.post(route("admin.subcategory.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("New Subcategory has been saved successfully");
      form.reset();
      if (fileList) fileList.value = null;
      fileSrc.value = null;
    },
    onError: () => {
      toast.error(`Unable to save new subcategory`);
    },
  });
};
</script>

<style lang='css' scoped>
.img_container {
  width: 100px;
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