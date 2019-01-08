<template>
    <div>
        <h1>Contacts</h1>
        <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
            <div class="form-group">
                <label>Name</label>
                <input v-model="contact.name" type="text" name="name" value="" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input v-model="contact.email" type="text" name="email" value="" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input v-model="contact.phone" type="text" name="phone" value="" class="form-control">
            </div>
            <div class="form-group">
                <button v-show="!edit" type="submit" name="button" class="btn btn-primary">New Contact</button>
                <button v-show="edit" type="submit" name="button" class="btn btn-primary">Update Contact</button>
            </div>
        </form>

        <h1>Contacts</h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="contact in list">
               <strong>{{ contact.name }}</strong> {{ contact.phone }} {{ contact.email }} 
            <button @click="showContact(contact.id)" class="btn btn-default btn-sm">Edit</button>
            <button @click="deleteContact(contact.id)" class="btn btn-danger btn-sm">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data: function () {  
        return {
            edit:false,
            list:[],
            contact:{
                id:'',
                name:'',
                email:'',
                phone:'',
            }
        }
    },
    mounted: function(){
        console.log('Run first Vuejs');
        this.fetchContactList();
    },
    methods: {
        showContact:function (id) {  
            let seft=this;
            axios.get('api/contact/'+id)
            .then(function(response){
                seft.contact.id=response.data.id;
                seft.contact.name=response.data.name;
                seft.contact.phone=response.data.phone;
                seft.contact.email=response.data.email;
                seft.edit=true;
            }).catch(function (err) { 
                console.log(err);
                
            });
        },

        fetchContactList:function () {  
            axios.get('api/contacts')
            .then((response) =>{ 

                this.list=response.data;

            }).catch((error) =>{  
                console.log(error);
            });
        },
        
        createContact:function () { 
            console.log('create');

            let seft=this;
            let params = Object.assign({},seft.contact);

            console.log(params);
            axios.post('api/contact/store',params)
            .then(function(){
                seft.contact.name='';
                seft.contact.email='';
                seft.contact.phone='';
                seft.edit=false;
                seft.fetchContactList();
            })
            .catch(function(error){
                
                console.log(error);
            });
        },
        updateContact:function (id) {  
            console.log('update');

            let seft=this;
            let params = Object.assign({},seft.contact);

            console.log(params);
            axios.patch('api/contact/'+id,params)
            .then(function(){
                seft.contact.name='';
                seft.contact.email='';
                seft.contact.phone='';
                seft.edit=false;
                seft.fetchContactList();
            })
            .catch(function(error){
                console.log(error);
            });
        },

        deleteContact:function (id) {  
            let seft=this;
            axios.delete('api/contact/'+id)
            .then(function(){
                seft.fetchContactList();
            })
            .catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>

