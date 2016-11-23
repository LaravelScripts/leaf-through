require('./bootstrap');

Vue.component('json-reponse', require('./components/JsonResponse.vue'));

const app = new Vue({
    el: '#app',
    data: {
      message: '',
        pseudoclass: ''
    },
    methods: {
        sendConfirmation : function(){
            //Send to server
            this.$http.post('/sendconfirmationemail', {email: document.getElementById('email').value}).then((response) => {
            // set data on vm
                if(response.body.error){
                    this.pseudoclass = 'alert alert-danger';
                }else{
                this.pseudoclass = 'alert alert-success';
                 }
                this.message = response.body.message;
                //this.$set('someData', response.body);

            }, (response) => {
                // error callback
            });
        }
    }
});
