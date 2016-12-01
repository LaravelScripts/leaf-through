require('./bootstrap');

const app3 = new Vue({
    el: "#article-actions",
    methods: {
      deleteArticle: function(){
        var pathArray = window.location.pathname.split( '/' );

        this.$http.delete('/article/delete/'+pathArray[2]).then((response) => {
        // set data on vm
            if(response.body.error){
              console.log(response.body.message);
            }else{
              console.log(response.body.data);
            }
            //this.$set('someData', response.body);

        }, (response) => {
            // error callback
        });
      }
    }
});

const app2 = new Vue({
  el: "#share-link",
  data: {
    to: '',
    message: '',
    slack_notification: '',
    send_annotation: '',
  },
  watch: {
    to: function(newValue){
      if(newValue.length > 3){
        this.autocomplete(newvalue);
      }
    }
  },
  methods: {
    autocomplete: function(text){
      this.$http.post('/emailsuggestion', {text: this.to}).then((response) => {
      // set data on vm
          if(response.body.error){
              console.log(response.body.message);
          }else{
            console.log(response.body.data);
          }
          //this.$set('someData', response.body);

      }, (response) => {
          // error callback
      });
    },

    share: function(event){
      event.preventDefault();
      //event.target.disabled = 'true';

      var pathArray = window.location.pathname.split( '/' );
      //POST
      this.$http.post('/share', {article:pathArray[2], to:this.to, message:this.message}).then((response) => {
      // set data on vm
          if(response.body.error){
              console.log(response.body.message);
          }else{
            console.log(response.body.data);
          }
          //this.$set('someData', response.body);

      }, (response) => {
          // error callback
      });
    },
  }
});

const app = new Vue({
  el: "#add-link",
  data: {
  },
  methods: {
    extractHtml: function(){
      //POST
      this.$http.post('/savearticle', {url: document.getElementById('link').value}).then((response) => {
      // set data on vm
          if(response.body.error){
            console.log(response.body.message);
          }else{
            console.log(response.body.data);
          }
          //this.$set('someData', response.body);

      }, (response) => {
          // error callback
      });
    }
  }
});
