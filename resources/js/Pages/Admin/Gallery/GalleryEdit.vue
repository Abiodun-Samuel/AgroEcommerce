<template>
    <Head title="gallery" />

    <AdminLayout>
        <DashboardBreadcrump :step_one="step_one" :step_two="step_two" />
        <hr />

        <div class="container shadow-sm rounded bg-white">
            <FormError :errors="formEdit.errors" />

            <div class="gallery py-1">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="fw-bolder text-success">
                            Edit {{ gallery.title }}
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="my-1 col-lg-6 col-md-6 col-sm-6">
                        <label for="gallery_title" class="form-label"
                            >Gallery Title</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="gallery_title"
                            placeholder="gallery title"
                            v-model="formEdit.gallery_title"
                        />
                        <small class="text-danger fst-italic small"
                            >(Optional)</small
                        >
                    </div>
                   
                    <div class="my-1 col-lg-6 col-md-6 col-sm-6">
                        <label for="gallery_image" class="form-label"
                            >Gallery Image</label
                        >
                        <input
                            type="file"
                            class="form-control"
                            id="gallery_image"
                            @change="getFile($event)"
                            accept=".jpg, .jpeg, .png"
                        />
                        <div class="img_container mt-1" v-if="fileSrc">
                            <img
                                :src="fileSrc"
                                alt="gallery preview"
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
                </div>

                <div class="row">
                    <div class="col-12">
                        <button
                            :disabled="
                                formEdit.processing || !formEdit.gallery_img
                            "
                            @click="editGallery"
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
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import FormError from "@/Components/Common/FormError.vue";

const props = defineProps(["gallery"]);
const fileSrc = ref(JSON.parse(props.gallery.gallery_img)?.img_url);
const formEdit = useForm({
    gallery_img: props.gallery.gallery_img,
    gallery_title: props.gallery.title,
    gallery_img_id: JSON.parse(props.gallery.gallery_img)?.img_id,
    width: `${Math.floor(Math.random() * (900 - 300) + 300)}px`,
    height: `${Math.floor(Math.random() * (900 - 300) + 300)}px`,
    folder: "gallery",
});
const step_one = {
    slug: "gallery",
    link: true,
    route_name: "admin.gallery.index",
};
const step_two = {
    slug: props.gallery.title,
    link: false,
    route_name: null,
};

function getFile(e) {
    const fileList = e.target.files[0];
    formEdit.gallery_img = e.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
        fileSrc.value = reader.result;
    };
    reader.readAsDataURL(fileList);
}

function removeFile() {
    const fileList = document.getElementById("gallery_image");
    fileList.value = null;
    formEdit.gallery_img = null;
    fileSrc.value = null;
}

const editGallery = () => {
    formEdit.clearErrors();
    formEdit.post(route("admin.gallery.update", props.gallery.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Your gallery has been edit successfully");
            formEdit.reset();
        },
        onError: () => {
            toast.error(`Unable to edit gallery`);
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
