<template>

    <div class="m-t-md">

        <h1>{{ header }}</h1>

        <div class="panel panel-default">
            <div class="panel-heading font-bold">New Post</div>
            <div class="panel-body">
                <form @submit.prevent="onSubmitForm" role="form">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text"
                               v-model="form_data.title"
                               class="form-control"
                               placeholder="Title"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea
                                v-model="form_data.body"
                                class="form-control"
                                rows="10"
                                required
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Recommended</label>
                        <div>
                            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                <input type="checkbox"
                                       v-model="form_data.is_recommended">
                                <i></i>
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-danger animated shake" v-show="error_message">
                        {{ error_message }}
                    </div>

                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            :disabled="isUpdating"
                    >
                        Save
                    </button>
                </form>
            </div>
            <div class="panel-footer">
                <pre>{{ form_data | json }}</pre>
            </div>
        </div>

    </div>

</template>

<style>
</style>

<script>
    export default{
        props: ['header'],
        data(){
            return {
                form_data: {
                    is_recommended: false,
                },
                error_message: null,
                isUpdating: false,
            }
        },
        components: {},
        methods: {
            onSubmitForm(){
                console.log('onSubmitForm');

                console.log(this.form_data);

                var resource = this.$resource('posts', {});

                // save data
                this.error_message = null;
                this.isUpdating = true;
                resource.save({}, this.form_data).then(function (response) {
                    // success callback
                    console.log('Success');
                    console.log(response);
                    // redirect back when success
                    this.redirectToUrl('/posts');
                }, function (response) {
                    // error callback
                    console.error('Error');
                    console.log(response);
                    if (response.data.message) {
                        this.error_message = response.data.message
                    }
                    this.isUpdating = false;
                }).finally(function () {
                    // when completed
                });
            },
        },
        http: {
            root: '/api',
            headers: {
                Accept: 'application/x.someline.v1+json'
            }
        },
        ready() {
            console.log('Ready');
        }
    }
</script>