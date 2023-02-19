import{c as B,r as f,P as U,o as n,a as r,b as a,u as o,X as P,w as h,d as e,t,F as D,e as R,f as y,n as $,g as m,h as E,i as z,j,v as F,k as w,p as L,l as T,J as G}from"./app.636801a9.js";import{_ as J}from"./orders.1a99e062.js";import{A as O}from"./AdminLayout.c2efef3c.js";import{_ as X}from"./NoResult.97c56a94.js";import{D as Y}from"./DashboardBreadcrump.d592429a.js";import{I as _}from"./iconify.65236bb7.js";import{M as k}from"./Modal.23ac1dc4.js";import{P as q}from"./Pagination.626ca9e7.js";import{_ as H}from"./_plugin-vue_export-helper.cdc0426e.js";/* empty css                                                              *//* empty css                                                                   */const K="/build/assets/users.26a6afab.png",Q="/build/assets/subcategory.b4e641d1.png",I="/build/assets/product.9c3afb69.png";const s=i=>(L("data-v-38d93627"),i=i(),T(),i),W={class:"container"},Z={class:"row"},ee={class:"col-lg-3 col-md-6 col-sm-6 col-6 my-2"},se={class:"counters shadow rounded p-1"},te={class:"counter__text"},oe=s(()=>e("h4",{class:"pb-0 text-success fw-bolder"},"Users",-1)),le={class:"lead pb-0 text-dark fw-bolder"},ne=s(()=>e("div",{class:"counter__icon"},[e("img",{loading:"lazy",width:"40",src:K,alt:"users icon"})],-1)),ae={class:"col-lg-3 col-md-6 col-sm-6 col-6 my-2"},ce={class:"counters shadow rounded p-1"},ie={class:"counter__text"},de=s(()=>e("h4",{class:"pb-0 text-success fw-bolder"},"Categories",-1)),re={class:"lead pb-0 text-dark fw-bolder"},_e=s(()=>e("div",{class:"counter__icon"},[e("img",{loading:"lazy",width:"40",src:Q,alt:"category icon"})],-1)),ue={class:"col-lg-3 col-md-6 col-sm-6 col-6 my-2"},he={class:"counters shadow rounded p-1"},me={class:"counter__text"},pe=s(()=>e("h4",{class:"pb-0 text-success fw-bolder"},"Subcategories",-1)),be={class:"lead pb-0 text-dark fw-bolder"},ge=s(()=>e("div",{class:"counter__icon"},[e("img",{loading:"lazy",width:"40",src:J,alt:"orders icon"})],-1)),ve={class:"col-lg-3 col-md-6 col-sm-6 col-6 my-2"},fe={class:"counters shadow rounded p-1"},ye={class:"counter__text"},we=s(()=>e("h4",{class:"pb-0 text-success fw-bolder"},"Products",-1)),xe={class:"lead pb-0 text-dark fw-bolder"},ke=s(()=>e("div",{class:"counter__icon"},[e("img",{loading:"lazy",width:"40",src:I,alt:"products icon"})],-1)),Ce={class:"col-lg-3 col-md-6 col-sm-6 col-6 my-2"},Ae={class:"counters shadow rounded p-1"},Se={class:"counter__text"},Ue=s(()=>e("h4",{class:"pb-0 text-success fw-bolder"},"Orders",-1)),De={class:"lead pb-0 text-dark fw-bolder"},$e=s(()=>e("div",{class:"counter__icon"},[e("img",{loading:"lazy",width:"40",src:I,alt:"products icon"})],-1)),ze=s(()=>e("hr",null,null,-1)),Ie={class:"row"},Ne={class:"col-lg-12"},Ve={class:"user__table"},Me={key:0,class:"table-responsive"},Be={class:"table table-hover table-bordered"},Pe=s(()=>e("thead",{class:"table-dark"},[e("tr",null,[e("th",{scope:"col"},"S/N"),e("th",{scope:"col"},"Name"),e("th",{scope:"col"},"Role"),e("th",{scope:"col"},"Status"),e("th",{scope:"col"},"Asign Role"),e("th",{scope:"col"},"View Details"),e("th",{scope:"col"},"Delete")])],-1)),Re={scope:"row"},Ee={scope:"row",class:"d-flex align-items-center position-relative"},je=["src"],Fe={style:{"margin-left":"7px"},class:"small"},Le=["onClick"],Te=["onClick"],Ge=["onClick"],Je={key:1,class:"text-center"},Oe={class:"row mt-1"},Xe=s(()=>e("h4",{class:"modal-title text-dark d-flex align-items-center gap-1 fw-bolder"}," User Details ",-1)),Ye={class:"mb-1 d-flex justify-content-start gap-1 align-items-center"},qe=["src","alt"],He={class:"fw-bolder my-0 py-0 text-dark"},Ke={class:"fw-normal my-0 py-0 text-secondary"},Qe={class:"fw-normal my-0 py-0 text-secondary"},We={class:"fw-normal small my-0 py-0 text-warning"},Ze=s(()=>e("hr",null,null,-1)),es={class:"bg-white shadow-lg p-1 rounded"},ss={class:"fw-light my-0 py-0 text-secondary"},ts=s(()=>e("b",null,"Gender:",-1)),os={class:"fw-light my-0 py-0 text-secondary"},ls=s(()=>e("b",null,"Phone:",-1)),ns={class:"fw-light my-0 py-0 text-secondary"},as=s(()=>e("b",null,"Address:",-1)),cs={class:"fw-light my-0 py-0 text-secondary"},is=s(()=>e("b",null,"City:",-1)),ds={class:"fw-light my-0 py-0 text-secondary"},rs=s(()=>e("b",null,"State:",-1)),_s={class:"fw-light my-0 py-0 text-secondary"},us=s(()=>e("b",null,"Country:",-1)),hs={class:"modal-title text-warning d-flex align-items-center gap-1 fw-bolder"},ms=s(()=>e("h5",{class:"fw-bold text-secondary"},"Do you want to delete this user?",-1)),ps=s(()=>e("p",null,"The user's account will be deleted completely",-1)),bs={class:"d-flex gap-1 align-items-center"},gs=s(()=>e("span",null,"Yes, Delete",-1)),vs={key:0,class:"spinner-border spinner-border-sm mx-1",role:"status","aria-hidden":"true"},fs={class:"modal-title text-warning d-flex align-items-center gap-1 fw-bolder"},ys=s(()=>e("h5",{class:"fw-bold text-secondary"},"Select a new role",-1)),ws=s(()=>e("option",{value:"Admin"},"Admin",-1)),xs=s(()=>e("option",{value:"User"},"User",-1)),ks=[ws,xs],Cs={class:"d-flex gap-1 align-items-center"},As=s(()=>e("span",null,"Assign",-1)),Ss={key:0,class:"spinner-border spinner-border-sm mx-1",role:"status","aria-hidden":"true"},Us={__name:"AdminIndex",props:["users","categories_count","products_count","subcategories_count"],setup(i){const C=B(()=>G().props.auth.user),b=f(!1),x=f(!1),g=f(!1),l=f(null),v=U({id:null}),p=U({role:"User",user_id:null}),N=()=>{p.post(route("admin.update-role",p.user_id),{preserveScroll:!0,onSuccess:()=>{w.success("User's role has been updated successfully"),p.reset(),g.value=!1},onError:()=>{w.error("Unable to update the user's role")}})},V=()=>{v.delete(route("admin.user-delete",v.id),{preserveScroll:!0,onSuccess:()=>{w.success("User has been deleted successfully"),v.reset(),b.value=!1},onError:()=>{w.error("Unable to delete the user")}})};return(Ds,d)=>(n(),r(D,null,[a(o(P),{title:"Admin Dashboard"}),a(O,null,{default:h(()=>{var u,A;return[a(Y),e("div",W,[e("div",Z,[e("div",ee,[e("div",se,[e("div",te,[oe,e("h6",le,t((A=(u=i.users)==null?void 0:u.data)==null?void 0:A.length),1)]),ne])]),e("div",ae,[e("div",ce,[e("div",ie,[de,e("h6",re,t(i.categories_count),1)]),_e])]),e("div",ue,[e("div",he,[e("div",me,[pe,e("h6",be,t(i.subcategories_count),1)]),ge])]),e("div",ve,[e("div",fe,[e("div",ye,[we,e("h6",xe,t(i.products_count),1)]),ke])]),e("div",Ce,[e("div",Ae,[e("div",Se,[Ue,e("h6",De,t(i.products_count),1)]),$e])])]),ze,e("div",Ie,[e("div",Ne,[e("div",Ve,[i.users.data.length?(n(),r("div",Me,[e("table",Be,[Pe,e("tbody",null,[(n(!0),r(D,null,R(i.users.data,(c,M)=>(n(),r("tr",{key:c.id},[e("th",Re,t(M+1),1),e("td",Ee,[c.avatar?(n(),r("img",{key:0,src:c.avatar,width:"30",class:"rounded-circle shadow-sm",alt:"sub category image"},null,8,je)):(n(),y(o(_),{key:1,icon:"mdi:user-circle-outline",height:"40"})),e("span",Fe,t(c.first_name)+" "+t(c.last_name),1)]),e("td",null,[e("span",{style:{padding:"3px"},class:$([c.role=="Super Admin"?"fw-bolder text-danger":c.role=="Admin"?"bg-warning text-dark":"bg-warning text-light","small rounded"])},t(c.role),3)]),e("td",null,[e("span",{style:{padding:"2px"},class:$(["d-flex align-items-center text-light rounded small",c.email_verified_at?"bg-success":"bg-danger"])},[a(o(_),{height:"15",width:"15",icon:"material-symbols:verified-user-rounded"}),m(" "+t(c.email_verified_at?"Verified":"Unverified"),1)],2)]),e("td",null,[o(C).role==="Super Admin"?(n(),r("button",{key:0,onClick:S=>{g.value=!0,o(p).user_id=c.id},class:"btn btn-sm btn-outline-facebook"},[a(o(_),{icon:"eos-icons:role-binding",height:"15"})],8,Le)):(n(),y(o(_),{key:1,icon:"material-symbols:lock-person-outline-sharp",height:"15"}))]),e("td",null,[e("button",{onClick:S=>{l.value=c,x.value=!0},class:"btn btn-sm btn-outline-success"},[a(o(_),{icon:"ic:outline-remove-red-eye",height:"15"})],8,Te)]),e("td",null,[o(C).role==="Super Admin"?(n(),r("button",{key:0,onClick:S=>{b.value=!0,o(v).id=c.id},class:"btn btn-danger btn-sm"},[a(o(_),{icon:"material-symbols:lock-person-outline-sharp",height:"15"})],8,Ge)):(n(),y(o(_),{key:1,icon:"material-symbols:lock-person-outline-sharp",height:"15"}))])]))),128))])])])):(n(),r("div",Je,[a(X,{text:"No Users",link:!1})]))])])]),e("div",Oe,[a(q,{links:i.users.links},null,8,["links"])])])]}),_:1}),a(k,{show:x.value,size:"modal-md",footer:!0,onClose:d[0]||(d[0]=u=>x.value=!1)},E({header:h(()=>[Xe]),_:2},[l.value?{name:"body",fn:h(()=>[e("div",Ye,[l.value.avatar?(n(),r("img",{key:0,width:"60",class:"rounded-circle",src:l.value.avatar,alt:l.value.first_name},null,8,qe)):(n(),y(o(_),{key:1,icon:"mdi:user-circle-outline",height:"50"})),e("div",null,[e("h5",He,t(l.value.first_name)+" "+t(l.value.last_name)+" ("+t(l.value.initial)+") ",1),e("p",Ke,t(l.value.email),1),e("p",Qe,t(l.value.gender),1),e("p",We,t(l.value.role),1)])]),Ze,e("div",es,[e("p",ss,[ts,m(" "+t(l.value.gender),1)]),e("p",os,[ls,m(" "+t(l.value.phone),1)]),e("p",ns,[as,m(" "+t(l.value.address),1)]),e("p",cs,[is,m(" "+t(l.value.city),1)]),e("p",ds,[rs,m(" "+t(l.value.state),1)]),e("p",_s,[us,m(" "+t(l.value.country),1)])])]),key:"0"}:void 0]),1032,["show"]),a(k,{show:b.value,size:"modal-sm",footer:!0,onClose:d[2]||(d[2]=u=>b.value=!1)},{header:h(()=>[e("h4",hs,[a(o(_),{icon:"icon-park-outline:caution"}),m(" Caution ")])]),body:h(()=>[ms,ps]),footer:h(()=>[e("div",bs,[e("button",{onClick:V,class:"btn btn-sm btn-danger"},[gs,o(v).processing?(n(),r("span",vs)):z("",!0)]),e("button",{onClick:d[1]||(d[1]=u=>b.value=!1),class:"btn btn-sm btn-success"}," No, Cancel ")])]),_:1},8,["show"]),a(k,{show:g.value,size:"modal-sm",footer:!0,onClose:d[5]||(d[5]=u=>g.value=!1)},{header:h(()=>[e("h4",fs,[a(o(_),{icon:"icon-park-outline:caution"}),m(" Caution ")])]),body:h(()=>[ys,j(e("select",{"onUpdate:modelValue":d[3]||(d[3]=u=>o(p).role=u),class:"form-select","aria-label":"Default select example"},ks,512),[[F,o(p).role]])]),footer:h(()=>[e("div",Cs,[e("button",{onClick:N,class:"btn btn-sm btn-danger"},[As,o(p).processing?(n(),r("span",Ss)):z("",!0)]),e("button",{onClick:d[4]||(d[4]=u=>g.value=!1),class:"btn btn-sm btn-success"}," Cancel ")])]),_:1},8,["show"])],64))}},Fs=H(Us,[["__scopeId","data-v-38d93627"]]);export{Fs as default};