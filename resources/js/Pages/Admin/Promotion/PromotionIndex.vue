<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";

defineProps(["promotions"]);

let fileSrc = ref(null);
const step_one = {
  slug: "Promotions",
  link: false,
  route_name: null,
};
const form = useForm({
  promotion_img: null,
  promotion_title: null,
  promotion_desc: null,
  folder: "promotion",
});

function getFile(e) {
  const fileList = (form.promotion_img = e.target.files[0]);
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}
function removeFile() {
  const fileList = document.getElementById("promotion_image");
  fileList.value = null;
  fileSrc.value = null;
}
const savePromotion = () => {
  form.clearErrors();
  const file = document.getElementById("promotion_image");
  form.post(route("admin.promotion.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("New promotion has been saved successfully");
      form.reset();
      file.value = null;
      fileSrc.value = null;
    },
    onError: () => {
      toast.error(`Unable to save new promotion`);
    },
  });
};
</script>

<template>
  <Head title="Promotions" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <FormError :errors="form.errors" />

      <div class="row">
        <div class="col-lg-12">
          <div class="promotion mb-2 shadow-sm bg-white rounded">
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
                    Promotion
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
                      <div class="my-1 col-lg-4 col-md-6 col-sm-6">
                        <label for="promotion_title" class="form-label"
                          >Promotion Title</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="promotion_title"
                          placeholder="Promotion title"
                          v-model="form.promotion_title"
                        />
                        <small class="text-danger fst-italic small"
                          >(Optional)</small
                        >
                      </div>
                      <div class="my-1 col-lg-4 col-md-6 col-sm-6">
                        <label for="promotion_title" class="form-label"
                          >Promotion Description</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="promotion_title"
                          placeholder="Promotion Description"
                          v-model="form.promotion_desc"
                        />
                        <small class="text-danger fst-italic small"
                          >(Optional)</small
                        >
                      </div>
                      <div class="my-1 col-lg-4 col-md-6 col-sm-6">
                        <div>
                          <label for="promotion_image" class="form-label"
                            >Promotion Image</label
                          >
                          <input
                            type="file"
                            class="form-control"
                            id="promotion_image"
                            accept=".jpg, .jpeg, .png"
                            @change="getFile($event)"
                          />
                        </div>
                        <div class="img_container mt-1" v-if="fileSrc">
                          <img
                            :src="fileSrc"
                            alt="promotion preview"
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
                            !form.promotion_img ||
                            !form.promotion_desc ||
                            !form.promotion_title
                          "
                          @click="savePromotion"
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
          <div class="promotion__table mt-2">
            <div class="table-responsive" v-if="promotions.length">
              <table class="table table-hover table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(promotion, index) in promotions"
                    :key="promotion.id"
                  >
                    <th scope="row">{{ index + 1 }}</th>
                    <td scope="row">{{ promotion.id.substring(0, 7) }}...</td>
                    <td>
                      <img
                        width="40"
                        :src="JSON.parse(promotion.banner_img)?.img_url"
                        alt="promotion image"
                      />
                    </td>
                    <td>{{ promotion.title }}</td>
                    <td>{{ promotion.description }}</td>
                    <td
                      class="
                        d-flex
                        gap-2
                        justify-content-start
                        align-items-center
                      "
                    >
                      <Link
                        :href="route('admin.promotion.edit', promotion.id)"
                        class="btn btn-success btn-sm"
                      >
                        <Icon
                          icon="material-symbols:edit-square-outline"
                          height="17"
                        />
                      </Link>
                      <button
                        @click="
                          showDeletepromotionModal = true;
                          formDelete.id = promotion.id;
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
</template>

<style scoped>
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