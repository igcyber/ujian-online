<template>
    <Head>
        <title>Tambah Kelas - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/classrooms"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                >
                    <i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali
                </Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-clone"></i> Tambah Kelas</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="">Nama Kelas</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan Nama Kelas"
                                    v-model="form.title"
                                />
                                <div
                                    v-if="errors.title"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.title }}
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-md btn-primary border-0 shadow me-2"
                            >
                                Simpan
                            </button>
                            <button
                                type="reset"
                                class="btn btn-md btn-warning border-0 shadow"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import LayoutAdmin from "../../../Layouts/Admin.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

export default {
    layout: LayoutAdmin,
    components: {
        Head,
        Link,
    },
    props: {
        errors: Object,
    },

    //inisialisasi Composition API
    setup() {
        const form = reactive({
            title: "",
        });

        //method submit
        const submit = () => {
            //send data to server
            Inertia.post(
                "/admin/classrooms",
                {
                    //request data
                    title: form.title,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Kelas Berhasil Disimpan!.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                }
            );
        };

        return {
            form,
            submit,
        };
    },
};
</script>
