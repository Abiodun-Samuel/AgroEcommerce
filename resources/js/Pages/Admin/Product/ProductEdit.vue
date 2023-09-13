<template>
  <Head title="Product" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <FormError :errors="form.errors" />

      <div class="product_form bg-white shadow-sm p-1 mb-2">
        <h5 class="fw-bolder text-success">Edit {{ product.title }}</h5>
        <hr />
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="categories" class="form-label">Categories</label>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="form.category_id"
              @change="selected"
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
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="sub_categories" class="form-label">SubCategories</label>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="form.subcategory_id"
            >
              <option selected disabled>Select SubCategory</option>
              <option
                v-for="subcategory in selectedCategory"
                :key="subcategory.id"
                :value="subcategory.id"
              >
                {{ subcategory.title }}
              </option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="product_title" class="form-label">Product Title</label>
            <input
              type="text"
              class="form-control"
              id="product_title"
              placeholder="product title"
              v-model="form.product_title"
            />
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="product_subtitle" class="form-label"
              >Product SubTitle
            </label>
            <input
              type="text"
              class="form-control"
              id="product_subtitle"
              placeholder="product subtitle"
              v-model="form.product_subtitle"
            />
            <span class="small text-danger fst-italic fw-normal"
              >(Optional)</span
            >
          </div>
        </div>
      </div>

      <div class="product_form bg-white shadow-sm p-1 mb-2">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="description" class="form-label">Product Image </label>
            <input
              id="product_image"
              type="file"
              class="form-control"
              @change="saveImage($event)"
              accept=".jpg, .jpeg, .png"
            />
            <span class="small text-danger fw-normal fst-italic"
              >(500px by 500px)</span
            >
            <div class="mt-1">
              <div class="img_container position-relative" v-if="fileSrc">
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

          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="pack_size" class="form-label">Pack size </label>
            <input
              type="text"
              class="form-control"
              id="pack_size"
              placeholder="Pack size"
              v-model="form.pack_size"
            />
            <span class="small text-danger fst-italic fw-normal"
              >(e.g 100ml, 500kg)</span
            >
          </div>

          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="product_brand" class="form-label">Product Brand</label>
            <input
              type="text"
              class="form-control"
              id="product_brand"
              placeholder="product brand"
              v-model="form.product_brand"
            />
          </div>
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="product_stock" class="form-label">Product Stock</label>
            <input
              type="number"
              class="form-control"
              id="product_stock"
              placeholder="product stock"
              v-model.number="form.product_stock"
            />
          </div>
        </div>
      </div>

      <div class="product_form bg-white shadow-sm p-1 mb-2">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-6 my-1">
            <label for="price" class="form-label"
              >Price <span class="text-danger">(&#8358;)</span></label
            >
            <input
              type="number"
              class="form-control"
              id="price"
              placeholder="Price"
              v-model.number="form.price"
            />
          </div>

          <div class="col-lg-6 col-md-6 col-6 my-1">
            <label for="discount_price" class="form-label"
              >Discount price <span class="text-danger">(&#8358;)</span>
            </label>
            <input
              type="number"
              class="form-control"
              id="discount_price"
              placeholder="Discount price"
              v-model.number="form.discountPrice"
            />
            <span class="small text-danger fst-italic fw-normal"
              >(Optional)</span
            >
          </div>

          <div class="col-lg-6 col-md-6 col-6 my-1">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea
              v-model="form.product_ingredient"
              class="form-control"
              id="ingredients"
            ></textarea>
            <small class="text-danger fst-italic fw-normal"
              >(Note: Apply a single space between ingredients, no comma)</small
            >
          </div>

          <div class="col-lg-6 col-md-6 col-6 my-1">
            <label for="description" class="form-label"
              >Product Description</label
            >
            <textarea
              v-model="form.product_description"
              class="form-control"
              id="description"
            ></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 text-end">
            <button
              @click="editProduct"
              :disabled="form.processing"
              class="btn btn-success"
            >
              <span>Edit</span>
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
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import FormError from "@/Components/Common/FormError.vue";
import { ref, reactive } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import PreLoader from "@/Components/Common/PreLoader.vue";
import { firstLetterUpperCase } from "@/utils/helper";

const props = defineProps(["product", "categories"]);

const selectedCategory = ref([]);
const fileSrc = ref(JSON.parse(props.product.image)?.img_url);

const step_one = {
  slug: "Product",
  link: false,
  route_name: null,
};
const form = useForm({
  category_id: props.product.category_id,
  subcategory_id: props.product.subcategory_id,
  product_title: props.product.title,
  product_subtitle: props.product.sub_title,
  pack_size: props.product.pack_size,
  product_brand: props.product.brands,
  product_image: props.product.image,
  product_stock: props.product.stock,
  price: props.product.price,
  product_ingredient: props.product.ingredients,
  product_description: props.product.description,
  discountPrice: props.product.discount_price,
  product_img_id: JSON.parse(props.product.image)?.img_id,
  folder: "products",
});

function deleteImage() {
  const fileList = document.getElementById("product_image");
  fileList.value = null;
  fileSrc.value = null;
  form.product_image = null;
}

const selected = (id, params) => {
  const filtered = props.categories.find(
    (subcategory) => subcategory.id === form.category_id
  );
  selectedCategory.value = filtered.subcategory;
};

function saveImage(e) {
  const fileList = (form.product_image = e.target.files[0]);
  const reader = new FileReader();
  reader.onloadend = () => {
    fileSrc.value = reader.result;
  };
  reader.readAsDataURL(fileList);
}

const editProduct = () => {
  form.clearErrors();
  form.post(route("admin.product.update", props.product.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success(
        firstLetterUpperCase(props.product.title) +
          " has been edited successfully"
      );
      form.reset();
    },
    onError: () => {
      toast.error(
        `Unable to edit ${firstLetterUpperCase(props.product.title)}`
      );
    },
  });
};
</script>

<style lang="css" scoped>
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