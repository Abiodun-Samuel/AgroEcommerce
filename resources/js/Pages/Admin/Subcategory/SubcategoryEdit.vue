<template>
  <Head title="Category" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" :step_two="step_two" />
    <hr />

    <div class="container shadow-sm rounded bg-white">
      <FormError :errors="formEdit.errors" />

      <div class="category py-1">
        <div class="row">
          <div class="col-lg-12">
            <h4 class="fw-bolder text-success">Edit {{ subcategory.title }}</h4>
          </div>
        </div>
        <div class="row">
          <div class="my-1 col-lg-4 col-md-6">
            <label for="category_image" class="form-label">Categories</label>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="formEdit.category_id"
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
              placeholder="category"
              v-model="formEdit.subcategory_title"
            />
          </div>
          <div class="my-1 col-lg-4 col-md-6">
            <label for="subcategory_image" class="form-label"
              >Subcategory Image</label
            >
            <input
              type="file"
              class="form-control"
              id="subcategory_image"
              @change="getFile($event)"
              accept=".jpg, .jpeg, .png"
            />
            <div class="img_container mt-1" v-if="fileSrc">
              <img :src="fileSrc" alt="category preview" width="100" />
              <button @click="removeFile">
                <Icon
                  color="text-danger"
                  icon="material-symbols:edit"
                  height="15"
                />
              </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button
              :disabled="
                formEdit.processing ||
                !formEdit.subcategory_img ||
                !formEdit.subcategory_title
              "
              @click="editSubcategory"
              class="btn btn-success"
            >
              <span>Edit</span>
              <span
                v-if="formEdit.processing"
                class="spinner-border spinner-border-sm mx-1"
                role="status"
                aria-hidden="true"
              ></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref, computed } from "vue";
import { toast, firstLetterUpperCase } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import FormError from "@/Components/Common/FormError.vue";

const props = defineProps(["subcategory"]);
const categories = computed(() => usePage().props.value.data.categories);
const fileSrc = ref(JSON.parse(props.subcategory.banner_img)?.img_url);
const formEdit = useForm({
  category_id: props.subcategory.category_id,
  subcategory_img: props.subcategory.banner_img,
  subcategory_title: props.subcategory.title,
  subcategory_img_id: JSON.parse(props.subcategory.banner_img)?.img_id,
  folder: "subcategory",
});
const step_one = {
  slug: "Subcategory",
  link: true,
  route_name: "admin.category.index",
};
const step_two = {
  slug: props.subcategory.title,
  link: false,
  route_name: null,
};

function getFile(e) {
  const fileList = e.target.files[0];
  formEdit.subcategory_img = e.target.files[0];
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}

function removeFile() {
  const fileList = document.getElementById("subcategory_image");
  fileList.value = null;
  formEdit.subcategory_img = null;
  fileSrc.value = null;
}

const editSubcategory = () => {
  formEdit.clearErrors();
  formEdit.post(route("admin.subcategory.update", props.subcategory.id), {
    onSuccess: () => {
      toast.success(
        firstLetterUpperCase(props.subcategory.title) +
          " has been edit successfully"
      );
      formEdit.reset();
    },
    onError: () => {
      toast.error(`Unable to edit ${props.subcategory.title}`);
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