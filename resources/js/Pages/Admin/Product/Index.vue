<template>
  <Head title="Products" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="my-1">
            <div class="table-responsive" v-if="products.length">
              <table class="table table-hover table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Subcategory</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price/Discount Price</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(product, index) in products" :key="product.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td scope="row">
                      <img
                        width="40"
                        :src="product.image"
                        alt="product image"
                      />
                    </td>
                    <td>{{ product.title }}</td>
                    <td>{{ product.sub_category.category.title }}</td>
                    <td>{{ product.sub_category.title }}</td>
                    <td>{{ product.stock }}</td>
                    <td>
                      &#8358;{{ product.price }} / &#8358;{{
                        product.discount_price ? product.discount_price : "---"
                      }}
                    </td>

                    <td
                      class="
                        d-flex
                        gap-2
                        justify-content-start
                        align-items-center
                      "
                    >
                      <button class="btn btn-primary btn-sm">
                        <Icon icon="ph:eye-bold" height="17" />
                      </button>
                      <button class="btn btn-success btn-sm">
                        <Icon
                          icon="material-symbols:edit-square-outline"
                          height="17"
                        />
                      </button>
                      <button
                        @click="
                          showDeleteProductModal = true;
                          formDelete.id = product.id;
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
              <NoResult text="No products found" :link="false" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>

  <Modal
    :show="showDeleteProductModal"
    :size="'modal-sm'"
    :footer="true"
    @close="showDeleteProductModal = false"
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
        Are you sure you want to delete this product?
      </h5>
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
          @click="showDeleteProductModal = false"
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
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { ref } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import NoResult from "@/Components/Common/NoResult.vue";
import Modal from "@/Components/Common/Modal.vue";

const props = defineProps(["products"]);
const showDeleteProductModal = ref(false);
const step_one = {
  slug: "Products",
  link: false,
  route_name: null,
};

const formDelete = useForm({
  id: null,
});

const deleteAction = () => {
  formDelete.delete(route("admin.product.destroy", formDelete.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Product has been deleted successfully");
      formDelete.reset();
      showDeleteProductModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to delete this product`);
    },
  });
};
</script>

<style lang="css" scoped>
</style>