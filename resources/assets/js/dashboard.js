require('./bootstrap');

const app = new Vue({
  el: "#share-link",
  data: {
    recipient: ''
  },
  watch: {
    recipient: function(newvalue){
      if(newvalue.length > 3){
        this.autocomplete(newvalue);
      }
    }
  },
  methods: {
    autocomplete: function(text){
      this.$http.post('/emailsuggestion', {text: document.getElementById('to').value}).then((response) => {
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
      //event.target.disabled = 'true';
      var link = document.getElementById('link').value;
      var message = document.getElementById('message').value;
      var to = document.getElementById('to').value;

      //POST
      this.$http.post('/share', {link:link, to:to, message:message}).then((response) => {
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

    extractHtml: function(){
      //POST
      this.$http.post('/extracthtml', {url: "http://martinbean.co.uk/blog/2014/09/08/whats-new-in-laravel-5/"}).then((response) => {
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
