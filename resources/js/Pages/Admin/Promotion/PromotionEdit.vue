<template>
  <Head title="Promotion" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" :step_two="step_two" />
    <hr />

    <div class="container shadow-sm rounded bg-white">
      <FormError :errors="formEdit.errors" />

      <div class="promotion py-1">
        <div class="row">
          <div class="col-lg-12">
            <h4 class="fw-bolder text-success">Edit {{ promotion.title }}</h4>
          </div>
        </div>
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
              v-model="formEdit.promotion_title"
            />
            <small class="text-danger fst-italic small">(Optional)</small>
          </div>
          <div class="my-1 col-lg-4 col-md-6 col-sm-6">
            <label for="promotion_title" class="form-label"
              >Promotion Desc</label
            >
            <input
              type="text"
              class="form-control"
              id="promotion_title"
              placeholder="Promotion desc"
              v-model="formEdit.promotion_desc"
            />
            <small class="text-danger fst-italic small">(Optional)</small>
          </div>
          <div class="my-1 col-lg-4 col-md-6 col-sm-6">
            <label for="promotion_image" class="form-label"
              >Promotion Image</label
            >
            <input
              type="file"
              class="form-control"
              id="promotion_image"
              @change="getFile($event)"
              accept=".jpg, .jpeg, .png"
            />
            <div class="img_container mt-1" v-if="fileSrc">
              <img :src="fileSrc" alt="promotion preview" width="100" />
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
              :disabled="formEdit.processing || !formEdit.promotion_img"
              @click="editPromotion"
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
import { Head, useForm } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref } from "vue";
import { toast, firstLetterUpperCase } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import FormError from "@/Components/Common/FormError.vue";

const props = defineProps(["promotion"]);
const fileSrc = ref(JSON.parse(props.promotion.banner_img)?.img_url);
const formEdit = useForm({
  promotion_img: props.promotion.banner_img,
  promotion_title: props.promotion.title,
  promotion_desc: props.promotion.description,
  promotion_img_id: JSON.parse(props.promotion.banner_img)?.img_id,
  folder: "promotion",
});
const step_one = {
  slug: "promotion",
  link: true,
  route_name: "admin.promotion.index",
};
const step_two = {
  slug: props.promotion.title,
  link: false,
  route_name: null,
};

function getFile(e) {
  const fileList = e.target.files[0];
  formEdit.promotion_img = e.target.files[0];
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}

function removeFile() {
  const fileList = document.getElementById("promotion_image");
  fileList.value = null;
  formEdit.promotion_img = null;
  fileSrc.value = null;
}

const editPromotion = () => {
  formEdit.clearErrors();
  formEdit.post(route("admin.promotion.update", props.promotion.id), {
    onSuccess: () => {
      toast.success(
        firstLetterUpperCase(props.promotion.title) +
          " has been edit successfully"
      );
      formEdit.reset();
    },
    onError: () => {
      toast.error(`Unable to edit ${props.promotion.title}`);
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