<script>
    import { ref } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FormLayout from '@/Pages/Events/Form.vue';
    // import DatePick from '@/Pages/Events/DatePicker.vue';
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
            FormLayout ,
            // DatePick
        },
        data() {
            return {
                eventsList: this.events
            }
        },
        props: ['events'],
        setup(props) {
            const form = useForm({
                title: null,
                description: null,
                start_date: null,
                end_date: null,
            });
            const delete_event = (id) => {
                if (confirm('Are you sure you want to delete this events ? ' + id)) {
                    Inertia.delete(route("delete_event", id));
                }
                
            };


            return {
                form,
                delete_event
            }
        },
        methods: {
            submit() {
                this.form.post(route("add_event"));
            },
            // submit_edit() {
            //     this.form_edit.put(route("edit_event", this.events.id_events));
            // },
            

        },
        

    }
    
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Events Management 
            </h2>
        </template>
        <div class="mt-5">
            <div>
                <!-- <DatePick/> -->
                <button type="button" class="btn btn-primary offset-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Add event</button>
            </div>
            <center>
                <table class="border border-slate-400 mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg pt-8 pb-8 mx-auto">
                    <thead>
                        <tr>
                            <th class="border border-slate-300 ...">Title</th>
                            <th class="border border-slate-300 ...">Description</th>
                            <th class="border border-slate-300 ...">Start_date</th>
                            <th class="border border-slate-300 ...">End_date</th>
                            <th class="border border-slate-300 ...">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="events in this.eventsList" key="events.id_events" class="root">
                            <td class="border border-slate-300 p-2">{{events.tittle}}</td>
                            <td class="border border-slate-300 p-2">{{events.description}}</td>
                            <td class="border border-slate-300 p-2">{{events.start_date}}</td>
                            <td class="border border-slate-300 p-2">{{events.end_date}}</td>
                            <td class="border border-slate-300 p-2">
                                <FormLayout v-bind:events="events"/>
                                <!-- <button type="button" class="btn btn-primary ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal_E" :href="route('edit_event', events.id_events)">Edit</button> -->
                                <button type="button" class="btn btn-danger ml-2" @click="delete_event(events.id_events)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
              
                </table>
            </center> 
        </div>

        <!-- Modal Add event-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Add event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" required v-model="form.title" id="title" name="title" placeholder="Enter a title" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" required v-model="form.description" id="description" name="description" placeholder="Enter a description" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start date</label>
                            <input type="date" class="form-control" required v-model="form.start_date" id="start_date" name="start_date" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End date</label>
                            <input type="date" class="form-control" required v-model="form.end_date" id="end_date" name="end_date">
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

        <!-- Modal Delete event-->
        <div class="modal fade" id="exampleModal_d" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Delete event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Do you realy wants to delete ?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" @click="delete_event(events.id_events)">Yes</button>
                </div>
                </div>
            </div>
        </div>
        
    
    </AppLayout>
    
</template>

