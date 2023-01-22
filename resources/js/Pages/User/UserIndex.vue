<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import NoResult from "@/Components/Common/NoResult.vue";
import DashboardBreadcrump from "@/Components/Dashboard/DashboardBreadcrump.vue";
import { Icon } from "@iconify/vue";
import { ref, computed } from "vue";
import Modal from "@/Components/Common/Modal.vue";
import Pagination from "@/Components/Partial/Pagination.vue";
import { toast } from "@/utils/helper";

const auth_user = computed(() => usePage().props.auth.user);
const props = defineProps([
  "users",
  "categories_count",
  "products_count",
  "subcategories_count",
]);
const openUserDeleteModal = ref(false);
const openUserDetailsModal = ref(false);
const openUserAssignRoleModal = ref(false);
const selectedUser = ref(null);

const formDelete = useForm({
  id: null,
});
const formAssign = useForm({
  role: "User",
  user_id: null,
});

const assignRoleAction = () => {
  formAssign.post(route("admin.update-role", formAssign.user_id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("User's role has been updated successfully");
      formAssign.reset();
      openUserAssignRoleModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to update the user's role`);
    },
  });
};
const deleteAction = () => {
  formDelete.delete(route("admin.user-delete", formDelete.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("User has been deleted successfully");
      formDelete.reset();
      openUserDeleteModal.value = false;
    },
    onError: () => {
      toast.error(`Unable to delete the user`);
    },
  });
};
</script>

<template>
  <Head title="Admin Dashboard" />

  <UserLayout>
    <DashboardBreadcrump />

    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Users</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ users?.data?.length }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/users.png"
                alt="users icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Categories</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ categories_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/subcategory.png"
                alt="category icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Subcategories</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ subcategories_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/orders.png"
                alt="orders icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Products</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ products_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/product.png"
                alt="products icon"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 my-2">
          <div class="counters shadow rounded p-1">
            <div class="counter__text">
              <h4 class="pb-0 text-success fw-bolder">Orders</h4>
              <h6 class="lead pb-0 text-dark fw-bolder">
                {{ products_count }}
              </h6>
            </div>
            <div class="counter__icon">
              <img
                loading="lazy"
                width="40"
                src="@/assets/images/icons/product.png"
                alt="products icon"
              />
            </div>
          </div>
        </div>
      </div>

      <hr />

      <!-- <div class="row">
        <div class="col-lg-12">
          <div class="user__table">
            <div class="table-responsive" v-if="users.data.length">
              <table class="table table-hover table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Asign Role</th>
                    <th scope="col">View Details</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in users.data" :key="user.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td
                      scope="row"
                      class="d-flex align-items-center position-relative"
                    >
                      <img
                        v-if="user.avatar"
                        :src="user.avatar"
                        width="30"
                        class="rounded-circle shadow-sm"
                        alt="sub category image"
                      />
                      <Icon v-else icon="mdi:user-circle-outline" height="40" />
                      <span style="margin-left: 7px" class="small"
                        >{{ user.first_name }} {{ user.last_name }}</span
                      >
                    </td>

                    <td>
                      <span
                        style="padding: 3px"
                        :class="
                          user.role == 'Super Admin'
                            ? 'fw-bolder text-danger'
                            : user.role == 'Admin'
                            ? 'bg-warning text-dark'
                            : 'bg-warning text-light'
                        "
                        class="small rounded"
                        >{{ user.role }}</span
                      >
                    </td>
                    <td>
                      <span
                        style="padding: 2px"
                        class="
                          d-flex
                          align-items-center
                          text-light
                          rounded
                          small
                        "
                        :class="
                          user.email_verified_at ? 'bg-success' : 'bg-danger'
                        "
                      >
                        <Icon
                          height="15"
                          width="15"
                          icon="material-symbols:verified-user-rounded"
                        />
                        {{ user.email_verified_at ? "Verified" : "Unverified" }}
                      </span>
                    </td>
                    <td>
                      <button
                        v-if="auth_user.role === 'Super Admin'"
                        @click="
                          openUserAssignRoleModal = true;
                          formAssign.user_id = user.id;
                        "
                        class="btn btn-sm btn-outline-facebook"
                      >
                        <Icon icon="eos-icons:role-binding" height="15" />
                      </button>
                      <Icon
                        v-else
                        icon="material-symbols:lock-person-outline-sharp"
                        height="15"
                      />
                    </td>
                    <td>
                      <button
                        @click="
                          selectedUser = user;
                          openUserDetailsModal = true;
                        "
                        class="btn btn-sm btn-outline-success"
                      >
                        <Icon icon="ic:outline-remove-red-eye" height="15" />
                      </button>
                    </td>
                    <td>
                      <button
                        v-if="auth_user.role === 'Super Admin'"
                        @click="
                          openUserDeleteModal = true;
                          formDelete.id = user.id;
                        "
                        class="btn btn-danger btn-sm"
                      >
                        <Icon
                          icon="material-symbols:lock-person-outline-sharp"
                          height="15"
                        />
                      </button>
                      <Icon
                        v-else
                        icon="material-symbols:lock-person-outline-sharp"
                        height="15"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div v-else class="text-center">
              <NoResult text="No Users" :link="false" />
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-1">
        <Pagination :links="users.links" />
      </div> -->
    </div>
  </UserLayout>

  <!-- open user details modal  -->
  <Modal
    :show="openUserDetailsModal"
    :size="'modal-md'"
    :footer="true"
    @close="openUserDetailsModal = false"
  >
    <template #header>
      <h4
        class="modal-title text-dark d-flex align-items-center gap-1 fw-bolder"
      >
        User Details
      </h4>
    </template>

    <template #body v-if="selectedUser">
      <div class="mb-1 d-flex justify-content-start gap-1 align-items-center">
        <img
          v-if="selectedUser.avatar"
          width="60"
          class="rounded-circle"
          :src="selectedUser.avatar"
          :alt="selectedUser.first_name"
        />
        <Icon v-else icon="mdi:user-circle-outline" height="50" />
        <div>
          <h5 class="fw-bolder my-0 py-0 text-dark">
            {{ selectedUser.first_name }} {{ selectedUser.last_name }} ({{
              selectedUser.initial
            }})
          </h5>
          <p class="fw-normal my-0 py-0 text-secondary">
            {{ selectedUser.email }}
          </p>
          <p class="fw-normal my-0 py-0 text-secondary">
            {{ selectedUser.gender }}
          </p>
          <p class="fw-normal small my-0 py-0 text-warning">
            {{ selectedUser.role }}
          </p>
        </div>
      </div>
      <hr />
      <div class="bg-white shadow-lg p-1 rounded">
        <p class="fw-light my-0 py-0 text-secondary">
          <b>Gender:</b> {{ selectedUser.gender }}
        </p>
        <p class="fw-light my-0 py-0 text-secondary">
          <b>Phone:</b> {{ selectedUser.phone }}
        </p>
        <p class="fw-light my-0 py-0 text-secondary">
          <b>Address:</b> {{ selectedUser.address }}
        </p>
        <p class="fw-light my-0 py-0 text-secondary">
          <b>City:</b> {{ selectedUser.city }}
        </p>
        <p class="fw-light my-0 py-0 text-secondary">
          <b>State:</b> {{ selectedUser.state }}
        </p>
        <p class="fw-light my-0 py-0 text-secondary">
          <b>Country:</b> {{ selectedUser.country }}
        </p>
      </div>
    </template>
  </Modal>
  <!-- delete user modal  -->
  <Modal
    :show="openUserDeleteModal"
    :size="'modal-sm'"
    :footer="true"
    @close="openUserDeleteModal = false"
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
      <h5 class="fw-bold text-secondary">Do you want to delete this user?</h5>
      <p>The user's account will be deleted completely</p>
    </template>

    <template #footer>
      <div class="d-flex gap-1 align-items-center">
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
          @click="openUserDeleteModal = false"
          class="btn btn-sm btn-success"
        >
          No, Cancel
        </button>
      </div>
    </template>
  </Modal>

  <!-- asign role modal  -->
  <Modal
    :show="openUserAssignRoleModal"
    :size="'modal-sm'"
    :footer="true"
    @close="openUserAssignRoleModal = false"
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
      <h5 class="fw-bold text-secondary">Select a new role</h5>
      <select
        v-model="formAssign.role"
        class="form-select"
        aria-label="Default select example"
      >
        <option value="Admin">Admin</option>
        <option value="User">User</option>
      </select>
    </template>

    <template #footer>
      <div class="d-flex gap-1 align-items-center">
        <button @click="assignRoleAction" class="btn btn-sm btn-danger">
          <span>Assign</span>
          <span
            v-if="formAssign.processing"
            class="spinner-border spinner-border-sm mx-1"
            role="status"
            aria-hidden="true"
          ></span>
        </button>
        <button
          @click="openUserAssignRoleModal = false"
          class="btn btn-sm btn-success"
        >
          Cancel
        </button>
      </div>
    </template>
  </Modal>
</template>

<style scoped>
.counters {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1.5px solid var(--green);
}
.counters h6 {
  background: var(--green-0);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2px;
  border-radius: 50%;
  height: 30px;
  width: 30px;
}
</style>