import{c as y,z as h,P as D,r as x,o as r,a,b as l,u as s,X as Q,w as b,d as t,t as d,i as g,bC as C,bF as X,j as P,C as I,f as z,n as B,g as N,q as T,F as q,e as F,bG as H,v as K,bD as Y,k as v,p as Z,l as tt,J as j,G as E}from"./app.281e0c63.js";import{R as S,P as et}from"./ProductComponent.312abc3e.js";import{_ as st}from"./FormError.f65ecb40.js";import{_ as ot}from"./GuestLayout.b1184634.js";import{B as nt}from"./BreadCrump.13ad1f1b.js";import{I as f}from"./iconify.a9b16b93.js";/* empty css                                                                   */import{_ as ct}from"./_plugin-vue_export-helper.cdc0426e.js";import{_ as it}from"./NoResult.5fa7e996.js";import{M as dt}from"./Modal.38fa62a9.js";import"./logo.30a607c9.js";/* empty css                                                              */const o=e=>(Z("data-v-c816ca30"),e=e(),tt(),e),rt={class:"container"},at={id:"productdetials bg-white shadow-sm"},lt={class:"row"},ut={class:"col-lg-5 col-md-6 mt-3 mb-1"},mt={class:"productdetials__image"},_t=["src","alt"],ht={class:"col-lg-7 col-md-6 mt-3 mb-1"},pt={class:"productdetials__text"},bt={class:"fw-bolder",style:{color:"var(--green-5)"}},gt={key:0,class:"fw-light text-secondary"},vt={class:"my-0 py-0"},ft=o(()=>t("hr",null,null,-1)),wt=o(()=>t("span",{class:"text-dark fw-normal"},"Brand: ",-1)),yt={class:"text-secondary fw-light"},kt=o(()=>t("span",{class:"text-dark fw-normal"},"Size: ",-1)),xt={class:"text-secondary fw-light"},Ct=o(()=>t("span",{class:"text-dark fw-normal"},"Subcategory: ",-1)),Pt={class:"text-secondary fw-light"},Nt=o(()=>t("span",{class:"text-dark fw-normal"},"Category: ",-1)),qt={class:"text-secondary fw-light"},St=o(()=>t("hr",null,null,-1)),Rt={class:"d-flex gap-3 align-items-center"},$t={class:"text-secondary fw-bolder"},Vt={key:0,class:"fw-normal text-danger text-decoration-line-through"},Dt={key:1,class:"small bg-warning rounded text-light",style:{padding:"2px"}},It=o(()=>t("span",{class:"text-dark fw-normal"},"Stock: ",-1)),zt={class:"text-secondary fw-light"},Bt={class:"d-flex align-items-stretch gap-1"},Tt=["disabled"],Ft=["max","disabled"],jt=["disabled"],Et=o(()=>t("hr",null,null,-1)),Lt={class:"d-flex gap-3 align-items-center"},Mt=["disabled"],Ut={key:0,class:"spinner-border spinner-border-sm me-1",role:"status","aria-hidden":"true"},Gt=o(()=>t("span",null,"Add to Cart",-1)),Wt=o(()=>t("hr",null,null,-1)),Ot={class:"row"},At={class:"col-lg-12"},Jt={class:"product__details my-1 bg-white shadow-sm p-1"},Qt={class:"d-flex gap-1 justify-content-between align-items-center"},Xt={class:"d-flex gap-1 align-items-center"},Ht=o(()=>t("hr",null,null,-1)),Kt={key:0,"data-aos":"zoom-in"},Yt=o(()=>t("p",{class:"text-dark fw-bolder"},"Ingredients",-1)),Zt={class:"text-secondary fw-normal"},te=o(()=>t("p",{class:"text-dark fw-bolder"},"Description",-1)),ee={class:"text-secondary fw-normal"},se={key:1,"data-aos":"zoom-in"},oe={class:"text-dark fw-bolder"},ne={class:"row"},ce={class:"col-lg-3 col-md-4 col-sm-4 my-1"},ie={class:"review__total rounded shadow-sm p-1"},de={class:"text-warning"},re={class:"text-dark"},ae={class:"col-lg-9 col-md-8 col-sm-8 my-1 review__box"},le={key:0,class:""},ue={class:"lead"},me={class:"text-dark fw-normal"},_e={class:"d-flex justify-content-between align-items-center"},he={class:"text-secondary fw-light mb-0 pb-0"},pe=o(()=>t("span",null," by ",-1)),be={class:"fw-normal"},ge={class:"d-flex align-items-center text-success fw-normal mb-0 pb-0"},ve=o(()=>t("span",null,"Verified",-1)),fe=o(()=>t("hr",null,null,-1)),we={key:1,class:"bg-white text-center"},ye=o(()=>t("h4",{class:"text-danger fw-bolder"},"No product reviews",-1)),ke=[ye],xe={class:"product__details my-1 bg-white shadow-sm p-1"},Ce=o(()=>t("div",{class:"row"},[t("h4",{class:"fw-bolder"},"Related Products"),t("hr")],-1)),Pe={key:0,class:"row"},Ne={key:1,class:"row"},qe={class:"col-lg-12 text-center"},Se={class:"modal-title text-primary d-flex align-items-center gap-1 fw-bolder"},Re={class:"my-1"},$e=o(()=>t("label",{for:"rating",class:"form-label"},"Rating",-1)),Ve=o(()=>t("option",{selected:"",disabled:""},"Select rating",-1)),De=o(()=>t("option",{value:"1"},"1 (Poor)",-1)),Ie=o(()=>t("option",{value:"2"},"2 (Fair)",-1)),ze=o(()=>t("option",{value:"3"},"3 (Good)",-1)),Be=o(()=>t("option",{value:"4"},"4 (Very Good)",-1)),Te=o(()=>t("option",{value:"5"},"5 (Excellent)",-1)),Fe=[Ve,De,Ie,ze,Be,Te],je={class:"my-1"},Ee=o(()=>t("label",{for:"comment",class:"form-label"},"Comment",-1)),Le=["disabled"],Me=o(()=>t("span",null,"Send",-1)),Ue={key:0,class:"spinner-border spinner-border-sm mx-1",role:"status","aria-hidden":"true"},Ge={__name:"ProductDetailsPage",props:{product:Object,relatedProducts:Array},setup(e){var V;const i=e,R=y(()=>j().props.auth.user);y(()=>j().props.data.categories);const L={slug:"Products",link:!0,route_name:"product-page"},M={slug:h(i.product.title),link:!1,route_name:null},_=D({rating:5,comment:null,product_id:i.product.id,user_id:(V=R.value)==null?void 0:V.id}),u=D({id:i.product.id,name:i.product.title,image:i.product.image,slug:i.product.slug,stock:i.product.stock,price:Number(i.product.discount_price)?Number(i.product.discount_price):Number(i.product.price),quantity:1}),w=x(!1),p=x("product-details");x(5);const $=y(()=>i.product.reviews.sort(function(m,n){return E(n.updated_at)-E(m.updated_at)})),k=y(()=>i.product.reviews.length?(i.product.reviews.reduce((c,J)=>c+J.rating,0)*5/(i.product.reviews.length*5)).toFixed(2):0),U=()=>{if(u.quantity===Number(i.product.stock))return null;u.quantity++},G=()=>{if(u.quantity<=1)return null;u.quantity--},W=m=>{const n={id:m.id,title:m.title,sub_title:m.sub_title,image:m.image,price:m.discount_price?m.discount_price:m.price,quantity:1};Y.dispatch("wishlistStore/addToWishList",n)},O=()=>{_.clearErrors(),_.post(route("user.send-review",i.product.id),{preserveScroll:!0,onSuccess:()=>{v.success("Review has been sent successfully"),_.reset(),w.value=!1},onError:()=>{v.error("Unable to send your review")}})},A=()=>{if(Number(i.product.stock)<=0)return v.error("Product is out of stock");if(u.quantity>Number(i.product.stock))return v.error("Product quantity is greater than the quantity in stock");u.post(route("add-to-cart"),{preserveScroll:!0,onSuccess:m=>{v.success(h(i.product.title)+" has been added to your cart."),u.reset()},onError:m=>{v.error(`${h(i.product.title)} is already in your cart.`)}})};return(m,n)=>(r(),a(q,null,[l(s(Q),{title:"Product Details"}),l(ot,null,{default:b(()=>[l(nt,{step_one:L,step_two:M}),t("div",rt,[t("div",at,[t("div",lt,[t("div",ut,[t("div",mt,[t("img",{src:JSON.parse(e.product.image).img_url,alt:e.product.title,class:"img-fluid rounded shadow-sm"},null,8,_t)])]),t("div",ht,[t("div",pt,[t("h3",bt,d(s(h)(e.product.title)),1),e.product.sub_title?(r(),a("p",gt,d(s(h)(e.product.sub_title)),1)):g("",!0),t("p",vt,[l(S,{value:s(k),text:`${e.product.reviews.length} Review${e.product.reviews.length>1?"s":""}`},null,8,["value","text"])]),ft,t("p",null,[wt,t("span",yt,d(e.product.brands),1)]),t("p",null,[kt,t("span",xt,d(e.product.pack_size),1)]),t("p",null,[Ct,t("span",Pt,d(e.product.subcategory.title),1)]),t("p",null,[Nt,t("span",qt,d(e.product.subcategory.category.title),1)]),St,t("div",Rt,[t("h1",$t," \u20A6"+d(e.product.discount_price?s(C)(e.product.discount_price):s(C)(e.product.price)),1),e.product.discount_price?(r(),a("p",Vt," \u20A6 "+d(s(C)(e.product.price)),1)):g("",!0),e.product.discount_price?(r(),a("p",Dt,d(s(X)(e.product.price,e.product.discount_price)),1)):g("",!0)]),t("p",null,[It,t("span",zt,d(Number(e.product.stock)>0?`${e.product.stock} (In Stock)`:`${e.product.stock} (Out of Stock)`),1)]),t("div",Bt,[t("button",{disabled:s(u).quantity<=1,onClick:G,class:"btn btn-sm btn-success"},[l(s(f),{icon:"ic:baseline-minus",width:"20"})],8,Tt),P(t("input",{class:"form-control w-25",type:"number",id:"quantity",name:"quantity",min:"1",max:e.product.stock,"onUpdate:modelValue":n[0]||(n[0]=c=>s(u).quantity=c),disabled:s(u).quantity<=1||s(u).quantity===Number(e.product.stock)||Number(e.product.stock)<=1},null,8,Ft),[[I,s(u).quantity,void 0,{number:!0}]]),t("button",{onClick:U,disabled:s(u).quantity===Number(e.product.stock)||Number(e.product.stock)===0,class:"btn btn-sm btn-success"},[l(s(f),{icon:"material-symbols:add",width:"20"})],8,jt)]),Et,t("div",Lt,[t("button",{disabled:Number(e.product.stock)===0||s(u).processing,onClick:A,class:"btn btn-success d-flex align-items-center"},[s(u).processing?(r(),a("span",Ut)):(r(),z(s(f),{key:1,icon:"ic:outline-shopping-cart",height:"19",class:"me-1"})),Gt],8,Mt),t("button",{onClick:n[1]||(n[1]=c=>W(e.product)),class:"wish_btn"},[l(s(f),{icon:"ph:heart",height:"20"})])])])])])]),Wt,t("div",Ot,[t("div",At,[t("div",Jt,[t("div",Qt,[t("div",Xt,[t("button",{onClick:n[2]||(n[2]=c=>p.value="product-details"),class:B([p.value=="product-details"?"btn-success":"btn-outline-success","btn btn-md"])}," Product Details ",2),t("button",{onClick:n[3]||(n[3]=c=>p.value="product-reviews"),class:B([p.value=="product-reviews"?"btn-success":"btn-outline-success","btn btn-md"])}," Product Reviews ",2)]),t("div",null,[s(R)?(r(),a("button",{key:0,onClick:n[4]||(n[4]=c=>w.value=!0),class:"btn btn-sm btn-outline-primary"}," Write a Review ")):(r(),z(s(T),{key:1,class:"btn btn-sm btn-outline-google",href:m.route("login")},{default:b(()=>[N("Login to write a review")]),_:1},8,["href"]))])]),Ht,p.value=="product-details"?(r(),a("div",Kt,[Yt,t("p",Zt,d(e.product.ingredients),1),te,t("p",ee,d(e.product.description),1)])):g("",!0),p.value=="product-reviews"?(r(),a("div",se,[t("p",oe," Verified ratings and comments ("+d(e.product.reviews.length)+") ",1),t("div",ne,[t("div",ce,[t("div",ie,[t("h2",de,d(s(k))+"/5",1),t("p",null,[l(S,{value:s(k)},null,8,["value"])]),t("p",re,d(e.product.reviews.length)+" Verified Rating"+d(e.product.reviews.length>1?"s":""),1)])]),t("div",ae,[s($).length?(r(),a("div",le,[(r(!0),a(q,null,F(s($),c=>(r(),a("div",{key:c.id},[t("p",ue,[l(S,{value:c.rating},null,8,["value"])]),t("p",me,d(c.comment),1),t("div",_e,[t("p",he,[t("span",null,d(s(H)(c.created_at)),1),pe,t("span",be,d(s(h)(c.user.first_name))+" "+d(s(h)(c.user.last_name)),1)]),t("p",ge,[l(s(f),{height:"15",width:"15",icon:"ic:baseline-verified-user",style:{"margin-right":"4px"}}),ve])]),fe]))),128))])):(r(),a("div",we,ke))])])])):g("",!0)])])]),t("div",xe,[Ce,e.relatedProducts.length?(r(),a("div",Pe,[(r(!0),a(q,null,F(e.relatedProducts,c=>(r(),a("div",{key:c.id,class:"col-lg-3 col-md-6"},[l(et,{product:c},null,8,["product"])]))),128))])):(r(),a("div",Ne,[t("div",qe,[l(it),l(s(T),{class:"btn btn-sm btn-success",href:m.route("product-page")},{default:b(()=>[N("Products")]),_:1},8,["href"])])]))])])]),_:1}),l(dt,{show:w.value,size:"modal-md",footer:!0,onClose:n[8]||(n[8]=c=>w.value=!1)},{header:b(()=>[t("h4",Se,[l(s(f),{icon:"jam:write-f"}),N(" Write a Review ")])]),body:b(()=>[l(st,{errors:s(_).errors},null,8,["errors"]),t("div",Re,[$e,P(t("select",{"onUpdate:modelValue":n[5]||(n[5]=c=>s(_).rating=c),class:"form-select","aria-label":"Default select rating"},Fe,512),[[K,s(_).rating,void 0,{number:!0}]])]),t("div",je,[Ee,P(t("textarea",{id:"comment",class:"form-control","onUpdate:modelValue":n[6]||(n[6]=c=>s(_).comment=c),rows:"4"},null,512),[[I,s(_).comment]])])]),footer:b(()=>[t("div",null,[t("button",{disabled:!s(_).comment||s(_).processing,onClick:O,class:"btn btn-sm btn-success mx-1"},[Me,s(_).processing?(r(),a("span",Ue)):g("",!0)],8,Le),t("button",{onClick:n[7]||(n[7]=c=>w.value=!1),class:"btn btn-sm btn-danger"}," No, Cancel ")])]),_:1},8,["show"])],64))}},ss=ct(Ge,[["__scopeId","data-v-c816ca30"]]);export{ss as default};
