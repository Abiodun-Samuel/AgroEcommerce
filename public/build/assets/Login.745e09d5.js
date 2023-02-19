import{c as v,j as k,bs as x,u as o,o as c,a as d,D as V,r as b,P as S,b as r,X as L,d as e,w as _,q as p,t as B,i as g,bw as C,f as D,g as f,F as U,k as h,bA as $,bB as q,y as F}from"./app.281e0c63.js";import{_ as N}from"./logo.30a607c9.js";import{S as P}from"./Side.1b5a72f4.js";import{_ as w,a as y,b as R}from"./TextInput.9834ec49.js";import"./iconify.a9b16b93.js";import"./_plugin-vue_export-helper.cdc0426e.js";const A=["value"],E={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(l,{emit:s}){const u=l,n=v({get(){return u.checked},set(t){s("update:checked",t)}});return(t,a)=>k((c(),d("input",{type:"checkbox",value:l.value,"onUpdate:modelValue":a[0]||(a[0]=m=>V(n)?n.value=m:null),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,A)),[[x,o(n)]])}};const G={id:"auth",class:"row"},j={class:"col-lg-6 login__details mb-2"},M={class:"login__form"},W=e("img",{src:N,alt:"logo",class:"m-auto d-block mb-2",width:"98"},null,-1),I=e("div",{class:"my-2"},[e("h3",{class:"fw-bolder text-success"},"Welcome to SuperoAgrobase Ltd."),e("p",{class:"p"},"Login to your account. \u{1F44C}")],-1),J=e("hr",null,null,-1),T={key:0,class:"alert alert-success my-1 p-1"},X=["onSubmit"],z={class:"my-2"},H={class:"my-2"},K={class:"block my-1 d-flex align-items-center justify-content-between"},O={class:"d-flex align-items-center"},Q=e("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),Y={class:"my-2"},Z=["disabled"],ee={key:0,class:"spinner-border spinner-border-sm",role:"status","aria-hidden":"true"},se=e("hr",null,null,-1),oe={class:"my-1 text-center"},ce={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){b("password"),b("password");const s=S({email:"",password:"",remember:!1}),u=()=>{s.post(route("login"),{onFinish:t=>{s.reset("password")},onSuccess:()=>{h.success("Login was successful"),s.reset()},onError:t=>{if(t.email)return h.error(t.email);if(t.password)return h.error(t.password)}})},n=t=>{const a=$(t.credential);q.post(route("google.login.callback"),a)};return(t,a)=>{const m=F("GoogleLogin");return c(),d(U,null,[r(o(L),{title:"Sign In"}),e("div",G,[e("div",j,[e("div",M,[r(o(p),{href:"/"},{default:_(()=>[W]),_:1}),I,J,l.status?(c(),d("div",T,B(l.status),1)):g("",!0),e("form",{onSubmit:C(u,["prevent"])},[e("div",z,[r(w,{for:"email",value:"Email"}),r(y,{id:"email",type:"email",class:"form-control",modelValue:o(s).email,"onUpdate:modelValue":a[0]||(a[0]=i=>o(s).email=i),required:"",autofocus:""},null,8,["modelValue"])]),e("div",H,[r(w,{for:"password",value:"Password"}),r(y,{id:"password",type:"password",class:"form-control",modelValue:o(s).password,"onUpdate:modelValue":a[1]||(a[1]=i=>o(s).password=i),required:"",autocomplete:"current-password"},null,8,["modelValue"]),r(R,{class:"mt-1",message:o(s).errors.password},null,8,["message"])]),e("div",K,[e("label",O,[r(E,{name:"remember",checked:o(s).remember,"onUpdate:checked":a[2]||(a[2]=i=>o(s).remember=i)},null,8,["checked"]),Q]),l.canResetPassword?(c(),D(o(p),{key:0,href:t.route("password.request"),class:"underline text-danger small text-gray-600 hover:text-gray-900 focus:outline-none"},{default:_(()=>[f(" Forgot your password? ")]),_:1},8,["href"])):g("",!0)]),e("div",Y,[e("button",{class:"btn btn-gradient-success w-100",disabled:o(s).processing},[o(s).processing?(c(),d("span",ee)):g("",!0),f(" Log in ")],8,Z)])],40,X),se,r(m,{callback:n}),e("div",oe,[r(o(p),{href:"/register",class:"text-danger small"},{default:_(()=>[f("Don't have account? SignUp")]),_:1})])])]),r(P)])],64)}}};export{ce as default};
