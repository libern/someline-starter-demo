import UserList from './vue/components/UserList.vue'
import PostList from './vue/components/Post/PostList.vue'
import NewPost from './vue/components/Post/NewPost.vue'

export default {
    data: {
        msg: "hello",
    },
    components: {
        'lt-user-list': UserList,
        'lt-post-list': PostList,
        'lt-new-post': NewPost,
    },
    methods: {
    },
    events: {
    },
    created(){
        console.log('Bootstrap.');
    }
}