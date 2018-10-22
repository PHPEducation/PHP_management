<template>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url(/assets/app/media/img//bg/bg-1.jpg);">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img v-bind:src="this.$store.state.baseUrlLogo + 'logo-1.png'">
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign In To Admin</h3>
                        </div>
                        <form class="m-login__form m-form" @submit.prevent="login">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email" v-model="email">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password" v-model="password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--light">
                                        <input type="checkbox" name="remember" v-model="remember_me"> Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__account">
                        <span class="m-login__account-msg">
                            Don't have an account yet ?
                        </span>&nbsp;&nbsp;
                        <router-link :to="{ name: 'register-account-trainee'}" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    name: 'login',
    data() {
        return {
            email: '',
            password: '',
            remember_me: false
        };
    },
    methods: {
        login() {
            this.$store
                .dispatch('login', {
                    email: this.email,
                    password: this.password,
                    remember_me: this.remember_me
                })
                .then(response => {
                    this.$router.push({ name: 'index' });
                });
        },
    },

}
</script>
