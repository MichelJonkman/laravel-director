import{_ as n}from"./preload-helper.f3170bb1.js";import{_ as c,D as t}from"./Dashboard.f97706d2.js";import{aS as a,an as s,bh as _,a_ as p,b0 as m,ao as d,au as l}from"./runtime-core.esm-bundler.3c4e4a0c.js";let i=document.body.getAttribute("data-test");const u={components:{Dashboard:t},data(){return{comp:null}},async beforeCreate(){const e=await n(()=>import(i),[]);console.log(e.default,t),this.comp=e.default}},f=l(" Peop ");function b(e,h,x,y,o,C){const r=p("dashboard");return a(),s(r,null,{default:_(()=>[f,o.comp?(a(),s(m(o.comp),{key:0})):d("",!0)]),_:1})}const E=c(u,[["render",b]]);export{E as default};