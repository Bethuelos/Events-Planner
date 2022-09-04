<script>
    import { ref } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    // import FormLayout from '@/pages/Events/Form.vue';
    import {Head, Link} from "@inertiajs/inertia-vue3";
    import {Inertia} from "@inertiajs/inertia";
    import { useForm } from "@inertiajs/inertia-vue3";

    import "bootstrap/dist/css/bootstrap.min.css";
    import "bootstrap/dist/js/bootstrap.min.js";

    // const isOpen = ref(true);

    export default {
        components: {
            AppLayout,
            Head,
            // FormLayout 
        },
        // data() {
        //     return {
        //         eventsList: this.events
        //     }
        // },
        props: ['events'],
        setup(props) {
            const form = useForm ({
                title: props.events.tittle,
                description: props.events.description,
                start_date: props.events.start_date,
                end_date: props.events.end_date,
            });

            return {
                form
            }
        },
        methods: {
            submit() {
                this.form.put(route("edit_event", this.events.id_events));
            },
        },
        

    }
    
</script>

<template>
    <button type="button" class="btn btn-primary ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal_E">Edit</button>

     <!-- Modal Edit event-->
        <div class="modal fade" id="exampleModal_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Edit event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" required v-model="form.title" name="title" placeholder="Enter a title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" required v-model="form.description" name="description" placeholder="Enter a description" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start date</label>
                        <input type="date" class="form-control" id="start_date" required v-model="form.start_date" name="start_date" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End date</label>
                        <input type="date" class="form-control" id="end_date" required v-model="form.end_date" name="end_date">
                    </div>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
</template>
