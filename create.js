import Vue from "vue";
import ProductMixin from "./mixins/ProductMixin";
import Errors from "@admin/js/Errors";
import { generateSlug } from "@admin/js/functions";
import axios from "axios"; // Import axios để gọi API

Vue.prototype.defaultCurrencySymbol = Ecommerce.defaultCurrencySymbol;

new Vue({
    el: "#app",

    mixins: [ProductMixin],

    data: {
        formSubmissionType: null,
        form: {
            brand_id: "",
            tax_class_id: "",
            is_active: true,
            media: [],
            is_virtual: false,
            manage_stock: 0,
            in_stock: 1,
            special_price_type: "fixed",
            meta: {},
            attributes: [],
            downloads: [],
            variations: [],
            variants: [],
            options: [],
            slug: null,
        },
        errors: new Errors(),
        selectizeConfig: {
            plugins: ["remove_button"],
        },
        searchableSelectizeConfig: {},
        categoriesSelectizeConfig: {},
        flatPickrConfig: {
            mode: "single",
            enableTime: true,
            altInput: true,
        },
    },

    created() {
        this.setSearchableSelectizeConfig();
        this.setCategoriesSelectizeConfig();
    },

    methods: {
        setProductSlug(value) {
            this.form.slug = generateSlug(value);
        },

        setFormDefaultData() {
            this.form = {
                brand_id: "",
                tax_class_id: "",
                is_active: true,
                media: [],
                is_virtual: false,
                manage_stock: 0,
                in_stock: 1,
                special_price_type: "fixed",
                meta: {},
                attributes: [],
                downloads: [],
                variations: [],
                variants: [],
                options: [],
                slug: null,
            };
        },

        resetForm() {
            this.setFormDefaultData();
            this.textEditor.get("description").setContent("");
            this.textEditor.get("description").execCommand("mceCancel");
            this.resetBulkEditVariantFields();

            this.focusField({
                selector: "#name",
            });
        },

        <!--submit({ submissionType }) {
            this.formSubmissionType = submissionType;
        },-->
        //sửa 
        submit({ submissionType }) {
        this.formSubmissionType = submissionType;
    
        axios.post("/admin/products/store", this.form)
            .then(response => {
                alert(response.data.message);
                this.resetForm(); // Reset form sau khi thêm thành công
            })
            .catch(error => {
                this.errors.record(error.response.data.errors);
            });
    }

    },
});
//nằm trong folder asset\admin\js
