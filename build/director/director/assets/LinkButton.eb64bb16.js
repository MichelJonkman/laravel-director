import{_ as s}from"./IconUrl.vue_vue_type_script_setup_true_async_true_lang.c75c7cb4.js";import{d as i,aS as n,an as r,bh as c,aZ as o,b0 as m,a8 as u,ao as f,au as h,ac as g,a9 as d}from"./runtime-core.esm-bundler.3c4e4a0c.js";import"./preload-helper.f3170bb1.js";const k=i({__name:"Link",props:{href:null,target:null},setup(e){let a="InertiaLink";if(e.target!=="_self"&&e.target!==null)a="a";else try{const t=new URL(window.location.href),l=new URL(e.href.replace(/^(https?:\/\/)?(\/\/)?/,"https://"));t.origin!==l.origin&&(a="a")}catch{}return(t,l)=>(n(),r(m(u(a)),{href:e.href,target:e.target},{default:c(()=>[o(t.$slots,"default")]),_:3},8,["href","target"]))}}),L=i({__name:"LinkButton",props:{element:null},setup(e){return(a,t)=>(n(),r(k,{href:e.element.url,title:e.element.title,target:e.element.target,class:d(["nav-link",{active:e.element.active}]),"aria-current":"page"},{default:c(()=>[e.element.iconUrl?(n(),r(s,{key:0,url:e.element.iconUrl,class:"icon me-1"},null,8,["url"])):f("",!0),h(" "+g(e.element.text),1)]),_:1},8,["href","title","target","class"]))}});export{L as default};
