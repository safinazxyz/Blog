<template>

        <div class="container">
            <div class="row">
                <div class="span12">
                    <h4 style="text-align:center"> <strong>Bizimle İletişime Geç</strong></h4>

                    <form role="form" class="contactForm" @submit.prevent="sendEnquiry()">
                        <div class="row">
                            <div class="span4 form-group">
                                <label for="nameId">Adınız</label>
                                <input type="text" class="form-control" id="nameId" placeholder="Ad"
                                       v-model="form.name" name="name"
                                       :class="{ 'is-invalid':form.errors.has('name')} ">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="span4 form-group">
                                <label for="emailId">E-Posta adresiniz</label>
                                <input type="email" class="form-control" id="emailId" placeholder="E-posta"
                                       v-model="form.email" name="email"
                                       :class="{ 'is-invalid':form.errors.has('email')} ">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="span4 form-group">
                                <label for="subjectId">Konu</label>
                                <input type="text" class="form-control" id="subjectId" placeholder="Konu"
                                       v-model="form.subject" name="subject"
                                       :class="{ 'is-invalid':form.errors.has('subject')} ">
                                <has-error :form="form" field="subject"></has-error>
                            </div>
                            <div class="span12 margintop10 form-group">
                                <label for="messageId">Mesajınız</label>
                                <textarea type="text" class="form-control" id="messagetId" placeholder="Mesaj"
                                       v-model="form.message" name="message"
                                          :class="{ 'is-invalid':form.errors.has('message')} " style="min-height:250px;"> </textarea>
                                <has-error :form="form" field="message"></has-error>
                                <p class="text-center">
                                    <button class="btn btn-large btn-theme margintop10" type="submit">Mesajını Gönder</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        name: "SendEnquiry",
        data() {
            return{
                form: new Form({
                    name:'',
                    email:'',
                    subject:'',
                    message:'',
                })
            }
        },

        methods: {
            sendEnquiry() {
                this.form.post('/blog-contact')
                    .then(()=>{
                        this.$router.push('/')
                        Toast.fire({
                            icon: 'success',
                            title: 'Mesajınız iletildi! Teşekkür ederiz.'
                        })
                    })
                    .catch(()=>{

                    })
            }
        }
    }
</script>

<style scoped>

</style>
