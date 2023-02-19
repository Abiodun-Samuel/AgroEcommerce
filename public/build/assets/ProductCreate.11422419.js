import{r as b,P as D,o as a,a as i,b as p,u as l,X as z,w as B,d as e,j as r,v as g,F as m,e as h,t as v,C as d,i as y,k as x,p as N,l as L,g as w}from"./app.281e0c63.js";import{A}from"./AdminLayout.8a21602c.js";import{D as E}from"./DashboardBreadcrump.8e740981.js";import{_ as T}from"./FormError.f65ecb40.js";import{I as j}from"./iconify.a9b16b93.js";/* empty css                                                                  */import{_ as F}from"./_plugin-vue_export-helper.cdc0426e.js";const c=n=>(N("data-v-d44b6e0f"),n=n(),L(),n),M=c(()=>e("hr",null,null,-1)),O={class:"container"},R={class:"product_form bg-white shadow-sm p-1 mb-2"},X={class:"row"},$={class:"col-lg-3 col-md-6 col-6 my-1"},q=c(()=>e("label",{for:"categories",class:"form-label"},"Categories",-1)),G=c(()=>e("option",{selected:"",disabled:""},"Select Category",-1)),H=["value"],J={class:"col-lg-3 col-md-6 col-6 my-1"},K=c(()=>e("label",{for:"sub_categories",class:"form-label"},"SubCategories",-1)),Q=c(()=>e("option",{selected:"",disabled:""},"Select SubCategory",-1)),W=["value"],Y={class:"col-lg-3 col-md-6 col-6 my-1"},Z=c(()=>e("label",{for:"product_title",class:"form-label"},"Product Title",-1)),ee={class:"col-lg-3 col-md-6 col-6 my-1"},te=c(()=>e("label",{for:"product_subtitle",class:"form-label"},"Product SubTitle ",-1)),oe=c(()=>e("span",{class:"small text-danger fst-italic fw-normal"},"(Optional)",-1)),se={class:"product_form bg-white shadow-sm p-1 mb-2"},le={class:"row"},ce={class:"col-lg-3 col-md-6 col-6 my-1"},re=c(()=>e("label",{for:"description",class:"form-label"},"Product Image ",-1)),de=c(()=>e("span",{class:"small text-danger fw-normal fst-italic"},"(500px by 500px)",-1)),ae={class:"mt-1"},ie={key:0,class:"img_container position-relative"},ne=["src"],ue={class:"col-lg-3 col-md-6 col-6 my-1"},pe=c(()=>e("label",{for:"pack_size",class:"form-label"},"Pack size ",-1)),_e=c(()=>e("span",{class:"small text-danger fw-normal fst-italic"},"(e.g 100ml, 500kg)",-1)),me={class:"col-lg-3 col-md-6 col-6 my-1"},fe=c(()=>e("label",{for:"product_brand",class:"form-label"},"Product Brand",-1)),be={class:"col-lg-3 col-md-6 col-6 my-1"},ge=c(()=>e("label",{for:"product_stock",class:"form-label"},"Product Stock",-1)),he={class:"product_form bg-white shadow-sm p-1 mb-2"},ve={class:"row"},ye={class:"col-lg-6 col-md-6 col-6 my-1"},xe=c(()=>e("label",{for:"price",class:"form-label"},[w("Price "),e("span",{class:"text-danger"},"(\u20A6)")],-1)),we={class:"col-lg-6 col-md-6 col-6 my-1"},ke=c(()=>e("label",{for:"discount_price",class:"form-label"},[w("Discount price "),e("span",{class:"text-danger"},"(\u20A6)")],-1)),Pe=c(()=>e("span",{class:"small text-danger fst-italic fw-normal"},"(Optional)",-1)),Ce={class:"col-lg-6 col-md-6 col-6 my-1"},Ve=c(()=>e("label",{for:"ingredients",class:"form-label"},"Ingredients",-1)),Se=c(()=>e("small",{class:"text-danger fst-italic fw-normal"},"(Note: Apply a single space between ingredients, no comma)",-1)),Ue={class:"col-lg-6 col-md-6 col-6 my-1"},Ie=c(()=>e("label",{for:"description",class:"form-label"},"Product Description",-1)),De={class:"row"},ze={class:"col-lg-12 text-end"},Be=["disabled"],Ne=c(()=>e("span",null,"save",-1)),Le={key:0,class:"spinner-border spinner-border-sm mx-1",role:"status","aria-hidden":"true"},Ae={__name:"ProductCreate",props:["categories"],setup(n){const k=n,f=b([]),_=b(null),P={slug:"Product",link:!1,route_name:null},o=D({category_id:null,subcategory_id:null,product_title:null,product_subtitle:null,pack_size:null,product_brand:null,product_image:null,product_stock:null,price:null,product_ingredient:null,product_description:null,discountPrice:null,folder:"products"});function C(){const u=document.getElementById("product_image");u.value=null,_.value=null,o.product_image=null}const V=(u,s)=>{const t=k.categories.find(I=>I.id===o.category_id);f.value=t.subcategory};function S(u){const s=o.product_image=u.target.files[0],t=new FileReader;t.onloadend=()=>{_.value=t.result},t.readAsDataURL(s)}const U=()=>{o.clearErrors(),o.post(route("admin.product.store"),{preserveScroll:!0,onSuccess:()=>{x.success("New Product has been saved successfully"),o.reset()},onError:()=>{x.error("Unable to save new product")}})};return(u,s)=>(a(),i(m,null,[p(l(z),{title:"Product"}),p(A,null,{default:B(()=>[p(E,{step_one:P}),M,e("div",O,[p(T,{errors:l(o).errors},null,8,["errors"]),e("div",R,[e("div",X,[e("div",$,[q,r(e("select",{class:"form-select","aria-label":"Default select example","onUpdate:modelValue":s[0]||(s[0]=t=>l(o).category_id=t),onChange:V},[G,(a(!0),i(m,null,h(n.categories,t=>(a(),i("option",{key:t.id,value:t.id},v(t.title),9,H))),128))],544),[[g,l(o).category_id]])]),e("div",J,[K,r(e("select",{class:"form-select","aria-label":"Default select example","onUpdate:modelValue":s[1]||(s[1]=t=>l(o).subcategory_id=t)},[Q,(a(!0),i(m,null,h(f.value,t=>(a(),i("option",{key:t.id,value:t.id},v(t.title),9,W))),128))],512),[[g,l(o).subcategory_id]])]),e("div",Y,[Z,r(e("input",{type:"text",class:"form-control",id:"product_title",placeholder:"product title","onUpdate:modelValue":s[2]||(s[2]=t=>l(o).product_title=t)},null,512),[[d,l(o).product_title]])]),e("div",ee,[te,r(e("input",{type:"text",class:"form-control",id:"product_subtitle",placeholder:"product subtitle","onUpdate:modelValue":s[3]||(s[3]=t=>l(o).product_subtitle=t)},null,512),[[d,l(o).product_subtitle]]),oe])])]),e("div",se,[e("div",le,[e("div",ce,[re,e("input",{id:"product_image",type:"file",class:"form-control",onChange:s[4]||(s[4]=t=>S(t)),accept:".jpg, .jpeg, .png"},null,32),de,e("div",ae,[_.value?(a(),i("div",ie,[e("img",{src:_.value,alt:"product preview",width:"100",class:"rounded shadow-sm"},null,8,ne),e("button",{class:"",onClick:C},[p(l(j),{color:"text-danger",icon:"material-symbols:edit",height:"15"})])])):y("",!0)])]),e("div",ue,[pe,r(e("input",{type:"text",class:"form-control",id:"pack_size",placeholder:"Pack size","onUpdate:modelValue":s[5]||(s[5]=t=>l(o).pack_size=t)},null,512),[[d,l(o).pack_size]]),_e]),e("div",me,[fe,r(e("input",{type:"text",class:"form-control",id:"product_brand",placeholder:"product brand","onUpdate:modelValue":s[6]||(s[6]=t=>l(o).product_brand=t)},null,512),[[d,l(o).product_brand]])]),e("div",be,[ge,r(e("input",{type:"number",class:"form-control",id:"product_stock",placeholder:"product stock","onUpdate:modelValue":s[7]||(s[7]=t=>l(o).product_stock=t)},null,512),[[d,l(o).product_stock,void 0,{number:!0}]])])])]),e("div",he,[e("div",ve,[e("div",ye,[xe,r(e("input",{type:"number",class:"form-control",id:"price",placeholder:"Price","onUpdate:modelValue":s[8]||(s[8]=t=>l(o).price=t)},null,512),[[d,l(o).price,void 0,{number:!0}]])]),e("div",we,[ke,r(e("input",{type:"number",class:"form-control",id:"discount_price",placeholder:"Discount price","onUpdate:modelValue":s[9]||(s[9]=t=>l(o).discountPrice=t)},null,512),[[d,l(o).discountPrice,void 0,{number:!0}]]),Pe]),e("div",Ce,[Ve,r(e("textarea",{"onUpdate:modelValue":s[10]||(s[10]=t=>l(o).product_ingredient=t),class:"form-control",id:"ingredients"},null,512),[[d,l(o).product_ingredient]]),Se]),e("div",Ue,[Ie,r(e("textarea",{"onUpdate:modelValue":s[11]||(s[11]=t=>l(o).product_description=t),class:"form-control",id:"description"},null,512),[[d,l(o).product_description]])])]),e("div",De,[e("div",ze,[e("button",{onClick:U,disabled:l(o).processing,class:"btn btn-success"},[Ne,l(o).processing?(a(),i("span",Le)):y("",!0)],8,Be)])])])])]),_:1})],64))}},Xe=F(Ae,[["__scopeId","data-v-d44b6e0f"]]);export{Xe as default};
