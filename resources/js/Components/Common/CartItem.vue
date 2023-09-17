<template>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <Link
                :href="
                    route('product-details-page', cartItem.associatedModel.slug)
                "
            >
                <img
                    :style="
                        cartItem.associatedModel.stock <= 0
                            ? 'filter: grayscale(100%)'
                            : ''
                    "
                    width="60"
                    height="60"
                    class="rounded"
                    :src="JSON.parse(cartItem.associatedModel.image).img_url"
                    :alt="cartItem.name"
                />
            </Link>
            <small class="fw-bold" style="margin: 5px 0;">{{
                cartItem.associatedModel.stock > 0
                    ? `In Stock (${cartItem.associatedModel.stock})`
                    : "Out of Stock"
            }}</small>
        </div>
        <div>
            <Link
                :href="
                    route('product-details-page', cartItem.associatedModel.slug)
                "
            >
                <h5 class="fw-bolder text-success lead">{{ cartItem.name }}</h5>
            </Link>
            <p class="fw-light my-0 py-0 small">
                Quantity:
                <span class="fw-bolder"> {{ cartItem.quantity }}</span>
            </p>
            <p class="fw-light rounded my-0 py-0 small">
                Price: &#8358; {{ cartItem.price }} X {{ cartItem.quantity }} =
                <span
                    class="fw-bold rounded"
                    style="background: var(--green-0); padding: 2px"
                    >&#8358; {{ cartItem.price * cartItem.quantity }}</span
                >
            </p>
        </div>
    </div>
    <hr />
    <div class="d-flex justify-content-between align-items-center">
        <button
            @click="removeFromCart(cartItem)"
            class="btn btn-sm btn-outline-danger"
            :disabled="formDelete.processing"
        >
            <span
                v-if="formDelete.processing"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
            ></span>
            <Icon
                v-else
                icon="material-symbols:delete-outline-rounded"
                height="18"
            />
        </button>

        <div class="d-flex align-items-stretch gap-1">
            <input
                type="number"
                v-model.number="formUpdate.quantity"
                class="form-control"
                style="width: 95px"
                @input="checkValue"
                placeholder="Quantity"
                :class="
                    cartItem.quantity > cartItem.associatedModel.stock ||
                    formUpdate.quantity <= 0 ||
                    formUpdate.quantity > cartItem.associatedModel.stock
                        ? 'border border-danger'
                        : null
                "
            />
            <button
                :disabled="
                    cartItem.quantity > cartItem.associatedModel.stock ||
                    loader ||
                    formUpdate.quantity <= 0 ||
                    formUpdate.quantity > cartItem.associatedModel.stock
                "
                @click="updateCart(cartItem)"
                class="btn btn-sm btn-success"
            >
                <span
                    v-if="loader"
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                ></span>
                <Icon v-else icon="akar-icons:edit" height="18" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { Link, useForm } from "@inertiajs/vue3";
import { toast } from "@/utils/helper";
import { ref } from "vue";

const loader = ref(false);
const props = defineProps(["cartItem"]);
const formUpdate = useForm({
    id: "",
    quantity: "",
});

const formDelete = useForm({
    id: "",
});
const checkValue = () => {
    if (
        props.cartItem.quantity > props.cartItem.associatedModel.stock ||
        formUpdate.quantity <= 0 ||
        formUpdate.quantity > props.cartItem.associatedModel.stock
    ) {
        toast.error("Please check item quantity.");
        return false;
    } else {
        return true;
    }
};
const updateCart = (params) => {
    let res = checkValue();
    if (!res) return;
    loader.value = true;
    formUpdate.clearErrors();
    formUpdate.id = params.id;

    formUpdate.put(route("update-cart"), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Product quantity has been updated successfully.");
            formUpdate.reset();
            loader.value = false;
        },
        onError: () => {
            toast.error(`Unable to update product quantity.`);
            loader.value = false;
        },
    });
};
const removeFromCart = (params) => {
    formDelete.clearErrors();
    formDelete.id = params.id;
    formDelete.put(route("remove-cart"), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Cart item has been removed successfully.");
            formDelete.reset();
        },
        onError: () => {
            toast.error(`Unable to remove cart item.`);
        },
    });
};
</script>

<style lang="scss" scoped></style>
