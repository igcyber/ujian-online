<template>
    <Head> <title>Edit Mata Pelajaran - Aplikasi Ujian Online</title> </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/lessons"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                >
                    <i class="fa fa-long-arrow-alt-left me-2"></i> Kembali
                </Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-bookmark"></i> Edit Pelajaran</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label>Nama Pelajaran</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Masukkan Nama Pelajaran"
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
//import layout
import LayoutAdmin from "../../../Layouts/Admin.vue";
//import head and link from inertia
import { Head, Link } from "@inertiajs/inertia-vue3";
//import reactive from Vue
import { reactive } from "vue";
//import inertia adapter
import { Inertia } from "@inertiajs/inertia";
//import sweet alert
import Swal from "sweetalert2";
//export component
export default {
    //layout master
    layout: LayoutAdmin,

    //register component
    components: {
        Head,
        Link,
    },

    //props
    props: {
        errors: Object,
        lesson: Object,
    },

    //Inisialiasi Composition API
    setup(props) {
        //define form with reactive
        const form = reactive({
            title: props.lesson.title,
        });

        //method submit
        const submit = () => {
            //send data to server to update data with Mehod PUT
            Inertia.put(
                `/admin/lessons/${props.lesson.id}`,
                {
                    //data
                    title: form.title,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Pelajaran Berhasil Diupdate!.",
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
<style></style>
