<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import Modal from "@/Components/Common/Modal.vue";

const props = defineProps(["galleries"]);

const showDeleteGalleryModal = ref(false);
let fileSrc = ref(null);
const step_one = {
    slug: "Gallery",
    link: false,
    route_name: null,
};
const form = useForm({
    gallery_img: null,
    gallery_title: null,
    width: `${Math.floor(Math.random() * (900 - 300) + 300)}px`,
    height: `${Math.floor(Math.random() * (900 - 300) + 300)}px`,
    folder: "gallery",
});

const formDelete = useForm({
    id: null,
});

function getFile(e) {
    const fileList = (form.gallery_img = e.target.files[0]);
    const reader = new FileReader();
    reader.onloadend = () => {
        fileSrc.value = reader.result;
    };
    reader.readAsDataURL(fileList);
}
function removeFile() {
    const fileList = document.getElementById("gallery_image");
    fileList.value = null;
    fileSrc.value = null;
}
const saveGallery = () => {
    form.clearErrors();
    const file = document.getElementById("gallery_image");
    form.post(route("admin.gallery.store"), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success(
                "New image has been saved into your gallery successfully"
            );
            form.reset();
            file.value = null;
            fileSrc.value = null;
        },
        onError: () => {
            toast.error(`Unable to save new image`);
        },
    });
};
const deleteGallery = () => {
    formDelete.delete(route("admin.gallery.destroy", formDelete.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success(
                "Image has been deleted from your gallery successfully"
            );
            formDelete.reset();
            showDeleteGalleryModal.value = false;
        },
        onError: () => {
            toast.error(`Unable to delete this image from your gallery`);
        },
    });
};
</script>

<template>
    <Head title="Gallery" />

    <AdminLayout>
        <DashboardBreadcrump :step_one="step_one" />
        <hr />

        <div class="container">
            <FormError :errors="form.errors" />

            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery mb-2 shadow-sm bg-white rounded">
                        <div
                            class="accordion accordion-flush"
                            id="accordionFlushExample"
                        >
                            <div class="accordion-item">
                                <h2
                                    class="accordion-header"
                                    id="flush-headingOne"
                                >
                                    <button
                                        class="accordion-button collapsed fw-bolder text-light shadow-sm bg-success"
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
                                        Gallery
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
                                            <div
                                                class="my-1 col-lg-6 col-md-6 col-sm-6"
                                            >
                                                <label
                                                    for="gallery_title"
                                                    class="form-label"
                                                    >Image Title</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="gallery_title"
                                                    placeholder="Image title"
                                                    v-model="form.gallery_title"
                                                />
                                                <small
                                                    class="text-danger fst-italic small"
                                                    >(Optional)</small
                                                >
                                            </div>
                                            <div
                                                class="my-1 col-lg-6 col-md-6 col-sm-6"
                                            >
                                                <div>
                                                    <label
                                                        for="gallery_image"
                                                        class="form-label"
                                                        >Gallery Image</label
                                                    >
                                                    <input
                                                        type="file"
                                                        class="form-control"
                                                        id="gallery_image"
                                                        accept=".jpg, .jpeg, .png"
                                                        @change="
                                                            getFile($event)
                                                        "
                                                    />
                                                </div>
                                                <div
                                                    class="img_container mt-1"
                                                    v-if="fileSrc"
                                                >
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
                                            <div class="col-lg-12">
                                                <button
                                                    :disabled="
                                                        form.processing ||
                                                        !form.gallery_img
                                                    "
                                                    @click="saveGallery"
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
                    <div class="gallery__table mt-2">
                        <div class="table-responsive" v-if="galleries.length">
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
                                        v-for="(gallery, index) in galleries"
                                        :key="gallery.id"
                                    >
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td scope="row">
                                            {{ gallery.id.substring(0, 7) }}...
                                        </td>
                                        <td>
                                            <img
                                                width="40"
                                                :src="
                                                    JSON.parse(
                                                        gallery.gallery_img
                                                    )?.img_url
                                                "
                                                alt="gallery image"
                                            />
                                        </td>
                                        <td>{{ gallery.title }}</td>
                                        <td
                                            class="d-flex gap-2 justify-content-start align-items-center"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'admin.gallery.edit',
                                                        gallery.id
                                                    )
                                                "
                                                class="btn btn-success btn-sm"
                                            >
                                                <Icon
                                                    icon="material-symbols:edit-square-outline"
                                                    height="17"
                                                />
                                            </Link>
                                            <button
                                                @click="
                                                    showDeleteGalleryModal = true;
                                                    formDelete.id = gallery.id;
                                                "
                                                class="btn btn-danger btn-sm"
                                            >
                                                <Icon
                                                    icon="ic:outline-delete-forever"
                                                    height="17"
                                                />
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center">
                            <NoResult text="No gallery found" :link="false" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
    <Modal
        :show="showDeleteGalleryModal"
        :size="'modal-sm'"
        :footer="true"
        @close="showDeleteGalleryModal = false"
    >
        <template #header>
            <h4
                class="modal-title text-warning d-flex align-items-center gap-1 fw-bolder"
            >
                <Icon icon="icon-park-outline:caution" />
                Caution
            </h4>
        </template>

        <template #body>
            <p class="text-danger lead">
                Are you sure you want to delete this image from your gallery?
            </p>
        </template>

        <template #footer>
            <div>
                <button
                    :disabled="formDelete.processing"
                    @click="deleteGallery"
                    class="btn btn-sm btn-danger mx-1"
                >
                    <span>Yes, Delete</span>
                    <span
                        v-if="formDelete.processing"
                        class="spinner-border spinner-border-sm mx-1"
                        role="status"
                        aria-hidden="true"
                    ></span>
                </button>
                <button
                    @click="showDeleteGalleryModal = false"
                    class="btn btn-sm btn-success"
                >
                    No, Cancel
                </button>
            </div>
        </template>
    </Modal>
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
