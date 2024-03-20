<template>
    <Head>
        <title>Edit Kelas - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/classrooms"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                >
                    <i class="fa fa-long-arrow-alt-left me-2"> </i>
                    Kembali
                </Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-clone"></i> Edit Kelas</h5>
                        <hr />

                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label>Nama Kelas</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Nama Kelas"
                                    v-model="form.title"
                                />
                                <div
                                    class="alert alert-danger mt-2"
                                    v-if="errors.title"
                                >
                                    {{ errors.title }}
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-md btn-primary border-0 shadow me-2"
                            >
                                Update
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

    //register components
    components: {
        Head,
        Link,
    },

    //props
    props: {
        errors: Object,
        classrooms: Object,
    },

    //insialisasi composition API
    setup(props) {
        //define form with reactive
        const form = reactive({
            title: props.classrooms.title,
        });

        //method submit
        const submit = () => {
            //send data to server
            Inertia.put(
                `/admin/classrooms/${props.classrooms.id}`,
                {
                    //data
                    title: form.title,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Kelas Berhasil Diupdate!.",
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
