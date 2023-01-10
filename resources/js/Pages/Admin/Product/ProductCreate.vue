<template>
  <Head title="New Product" />

  <AdminLayout>
    <DashboardBreadcrump :step_one="step_one" />
    <hr />

    <div class="container">
      <div class="product_form bg-white shadow-sm p-1 mb-2">
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
              >Product SubTitle</label
            >
            <input
              type="text"
              class="form-control"
              id="product_subtitle"
              placeholder="product subtitle"
              v-model="form.product_subtitle"
            />
          </div>
        </div>
      </div>

      <div class="product_form bg-white shadow-sm p-1 mb-2">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 my-1">
            <AdvancedImage :cldImg="cloud.image(cloud_prd_image_url)" />

            <form @submit.prevent="submit">
              <input ref="cloud_prd_image" type="file" />
              <!-- @input="form.file = $event.target.files[0]" -->
              <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
              >
                {{ form.progress.percentage }}%
              </progress>
              <button type="submit">Submit</button>
            </form>

            <label for="description" class="form-label">Product Image</label>
            <input
              type="file"
              class="form-control"
              id="category_image"
              @change="getFile($event)"
              accept=".jpg, .jpeg, .png"
            />
          </div>

          <div class="col-lg-3 col-md-6 col-6 my-1">
            <label for="pack_size" class="form-label">Pack size</label>
            <input
              type="text"
              class="form-control"
              id="pack_size"
              placeholder="Pack size"
              v-model="form.pack_size"
            />
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
            <label for="price" class="form-label">Price</label>
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
              >Discount price</label
            >
            <input
              type="number"
              class="form-control"
              id="discount_price"
              placeholder="Discount price"
              v-model.number="form.discountPrice"
            />
          </div>

          <div class="col-lg-6 col-md-6 col-6 my-1">
            <label for="ingredients" class="form-label">Ingredients</label>
            <textarea
              v-model="form.product_ingredient"
              class="form-control"
              id="ingredients"
            ></textarea>
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
              @click="save"
              :disabled="form.processing"
              class="btn btn-success"
            >
              <span>save</span>
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
import { Head, useForm } from "@inertiajs/inertia-vue3";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { AdvancedImage } from "@cloudinary/vue";
import { ref, reactive } from "vue";
import { toast } from "@/utils/helper";
import { Icon } from "@iconify/vue";
import { cloud } from "@/utils/helper";
const form = reactive({
  file: null,
});
const cloud_prd_image = ref(null);
const cloud_prd_image_url = ref(null);

function submit() {
  var formData = new FormData();
  const file = cloud_prd_image.value.files[0];
  formData.append("image", file);
  formData.append("folder", "products");
  axios
    .post(route("admin.cloudinary.store"), formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((res) => {
      cloud_prd_image_url.value = res.data;
      console.log(res.data);
    });

  // form.post(route("admin.cloudinary.store"), {
  //   preserveScroll: true,
  //   onSuccess: (res) => {
  //     toast.success("New Product has been saved successfully");
  //     form.reset();
  //     console.log(res);
  //   },
  //   onError: (err) => {
  //     toast.error(`Unable to save new product`);
  //     console.log(err);
  //   },
  // });
}

// const form = useForm({
//   category_id: null,
//   subcategory_id: null,
//   product_title: null,
//   product_subtitle: null,
//   pack_size: null,
//   product_brand: null,
//   product_image: null,
//   product_stock: null,
//   price: null,
//   product_ingredient: null,
//   product_description: null,
//   discountPrice: null,
// });

const props = defineProps(["categories"]);

const selectedCategory = ref([]);
const selected = (id, params) => {
  const filtered = props.categories.find(
    (subcategory) => subcategory.id === form.category_id
  );
  selectedCategory.value = filtered.sub_category;
};

const step_one = {
  slug: "New Product",
  link: false,
  route_name: null,
};

function getFile(e) {
  const fileList = e.target.files[0];
  const reader = new FileReader();
  reader.onloadend = () => {
    form.product_image = reader.result;
  };
  reader.readAsDataURL(fileList);
}
const save = () => {
  form.post(route("admin.product.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("New Product has been saved successfully");
      form.reset();
    },
    onError: () => {
      toast.error(`Unable to save new product`);
    },
  });
};
</script>

<style lang="css" scoped>
</style>