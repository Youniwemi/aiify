(()=>{"use strict";const e=window.wp.blocks,t=window.wp.hooks,n=window.wp.element,a=window.wp.i18n,o=window.wp.blockEditor,r=window.wp.components,i=wp.data.select("core/block-editor"),l=wp.data.dispatch("core/block-editor"),c=i.getBlock,s=i.getBlockIndex,d=l.insertBlock,u=l.updateBlockAttributes,p=(l.updateBlock,i.getBlockRootClientId),m=(l.insertAfterBlock,l.insertBeforeBlock,l.removeBlocks),g=l.removeBlock,f=wp.blocks.switchToBlockType,w=wp.blocks.createBlock,h=wp.data.dispatch("core/notices").createErrorNotice,y=["core/paragraph","core/heading","core/group","core/code","core/pullquote","core/quote","core/verse","core/list","core/list-item"],b=e=>{m(c(e).innerBlocks.map((e=>e.clientId)))},v=e=>(e=(e=e.replace(/\[(.*?)\]\((.*?)\)/g,'<a href="$2">$1</a>')).replace(/\*\*(.*?)\*\*/g,"<strong>$1</strong>")).replace(/\*(.*?)\*/g,"<em>$1</em>"),k=function(e,t){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};switch(e){case"core/quote":case"core/pullquote":var a=t.split(" - ");a.length>1&&(n.citation=a.pop(),t=a.join(" - ")),n.value=v(t);break;default:n.content=v(t)}return w(e,n)},E=async(e,t,n,a)=>{var o=k(e,t.trimStart(),a);const r=c(n);r.innerBlocks;var i=r.innerBlocks?r.innerBlocks.length:0;return await d(o,i,n),await c(n).innerBlocks[i]},C=e=>"- "==e.slice(0,2)||"- "==e||"-"==e,B=e=>{let{idBlock:t,prompt:n,context:o,keywords:r,edit:i,setAttributes:l,insertAfter:m,onDone:y}=e;var B=new FormData;B.append("action","open_ai");const{style:_,tone:x,language:S,maxWords:M,nonce:A}=window.aiify;B.append("openai_nonce",A),B.append("style",_),B.append("tone",x),B.append("language",S),B.append("maxWords",M),i&&B.append("edit",i),B.append("prompt",n),B.append("context",o),B.append("keywords",r);var N=c(t),I="core/group"==N.name||"core/list"==N.name,F=new URLSearchParams(B).toString(),$=new EventSource(window.ajaxurl+"?"+F),q="",T={},D=!1,G=!1,P=!1,j=!1,O="core/paragraph",W="",H=t,R=!0,Z=!0,L=!1,J=!1,z=!1,U=!1,V=!1,K=null;const Q="after"==m;var X=!0;const Y=()=>{console.log("Answer completed",q),y&&y()};$.onmessage=async function(e){if(X){X=!1,console.log(e);const t=JSON.parse(e.data);return"messages"in t&&console.log(t.messages.map((e=>e.content)).join("\n\n")),"prompt"in t&&console.log(t.prompt),void("error"in t&&h(t.error.message,{type:"snackbar",explicitDismiss:!0}))}if("[DONE]"==e.data){if($.close(),m)g(K.innerBlocks[0].clientId);else if(i)return"core/paragraph"!==O&&f(c(H),O),u(H,{content:v(W.trimStart()),name}),void Y();return E(O,W,H,T),void Y()}var n=JSON.parse(e.data);console.log(n);var o="";if("text"in n.choices[0])o=n.choices[0].text;else{if(!("content"in n.choices[0].delta))return;o=n.choices[0].delta.content}if(q+=o,!R||(R=!1,"\n\n"!=o&&""!=o)){if(i)if(m)0==V&&(K=await async function(e,t,n,o){let r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{};var i=null;if("core/group"==e){const t=w("core/paragraph",{content:(0,a.__)("Please wait...","aiify")});i=w(e,{layout:{type:"constrained"},tagName:"div"},[t])}else if(t&&C(t)){e="core/list";var l=t.split("\n").map((e=>w("core/list-item",{content:e.substr(2)})));i=w(e,{},l)}else i=k(e,t.trimStart(),r);var c=s(n),u=p(n);return console.log("Block index  ",n,c),await d(i,o?c+1:c,u),i}("core/group",null,H,Q),H=t=K.clientId,V=!0);else{if(!I)return"##"==o.slice(0,2)?(O="core/heading",void(T={level:o.length})):void(W+=o);0==U&&(console.log("clearing"),b(t),U=!0)}0==D?(D=!0,T={},">"==o.slice(0,1)||"&gt;"==o.slice(0,4)?(O="core/pullquote",H=t,z=!0,J=!1,j=!1):"##"==o.slice(0,2)?(O="core/heading",H=t,J=!0,j=!1,z=!1,T={level:o.length}):C(o)?(0==j&&(j=!0,P=await E("core/list","",H),console.log("injected  list",P),H=P.clientId,Z=!0),L=!0,J=!1,z=!1,O="core/list-item"):(O="core/paragraph",H=t,j=!1,J=!1,z=!1)):"\n\n"!=o.slice(-2)&&"\n"!=o.slice(-1)||(G=!0),L||J||z?(L=!1,J=!1,z=!1):W+=o,G&&(j&&Z?(c(P.clientId).innerBlocks[0].attributes.content=v(W.trimStart()),Z=!1):await E(O,W,H,T),W="",G=!1,D=!1),l({reply:q})}},$.onerror=function(e){$.close(),Y()}},_=(0,n.createElement)("svg",{id:"Layer_1","data-name":"Layer 1",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 553.84 552.02"},(0,n.createElement)("path",{fill:"#6f52a2",d:"M.67,.18H371.96c99.34,0,180,80.66,180,180v371.29H180.67C81.32,551.47,.67,470.82,.67,371.47V.18H.67Z"}),(0,n.createElement)("g",null,(0,n.createElement)("path",{fill:"#fff",d:"M243.54,394.07c-23.45,0-43.15-8.03-59.11-24.1-15.96-16.07-23.94-35.83-23.94-59.28s7.98-43.15,23.94-59.11c15.96-15.96,35.66-23.94,59.11-23.94s43.2,7.98,59.28,23.94c16.06,15.96,24.1,35.66,24.1,59.11v60.9c0,6.52-2.07,11.78-6.19,15.8-4.13,4.01-9.45,6.02-15.96,6.02s-11.78-2.01-15.8-6.02c-4.02-4.02-6.02-9.28-6.02-15.8v-60.9c0-10.85-3.86-20.08-11.56-27.68-7.71-7.6-16.99-11.4-27.85-11.4s-20.08,3.8-27.68,11.4c-7.6,7.61-11.4,16.83-11.4,27.68s3.8,20.14,11.4,27.85c7.6,7.71,16.82,11.56,27.68,11.56,6.51,0,11.83,2.01,15.96,6.03,4.12,4.02,6.19,9.28,6.19,15.79s-2.07,11.84-6.19,15.96c-4.13,4.13-9.45,6.19-15.96,6.19Z"}),(0,n.createElement)("path",{fill:"#fff",d:"M385.37,165.93c5.32,5.33,7.98,11.68,7.98,19.06s-2.66,13.74-7.98,19.05c-5.32,5.32-11.67,7.98-19.05,7.98s-13.74-2.66-19.05-7.98c-5.32-5.32-7.98-11.67-7.98-19.05s2.66-13.73,7.98-19.06c5.32-5.32,11.67-7.98,19.05-7.98s13.73,2.66,19.05,7.98Zm3.09,83.54c0-14.54-7.38-21.82-22.15-21.82-6.52,0-11.78,2.01-15.8,6.02-4.02,4.02-6.03,9.28-6.03,15.79v122.13c0,6.52,2.01,11.78,6.03,15.8,4.01,4.01,9.28,6.02,15.8,6.02s11.83-2.01,15.96-6.02c4.12-4.02,6.19-9.28,6.19-15.8v-122.13Z"}))),x=(0,n.createElement)("svg",{width:"135",height:"140",viewBox:"0 0 135 140",xmlns:"http://www.w3.org/2000/svg",fill:"#fff"},(0,n.createElement)("rect",{y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.5s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.5s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"30",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.25s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.25s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"60",width:"15",height:"140",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"90",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.25s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.25s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"120",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.5s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.5s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"}))),S="aiify/aiify",M=window.wp.compose,A=(0,M.createHigherOrderComponent)((e=>t=>{const{name:i,attributes:l,setAttributes:c}=t,{styles:s,tones:d,maxWords:u,style:p,tone:m,languages:g,language:f}=window.aiify;if((e=>y.concat(["aiify/aiify"]).includes(e))(i)&&t.isSelected){const i=e=>{const[t,o]=(0,n.useState)(parseInt(u)),[i,l]=(0,n.useState)(m),[c,w]=(0,n.useState)(p),[h,y]=(0,n.useState)(f);return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(r.RangeControl,{min:0,max:2e3,label:(0,a.__)("Max words to generate","aiify"),help:(0,a.__)("Do not exceed this value","aiify"),value:parseInt(t),onChange:e=>{window.aiify.maxWords=e,o(e)}}),(0,n.createElement)(r.SelectControl,{label:(0,a.__)("Select writing style","aiify"),onChange:e=>{window.aiify.style=e,w(e)},options:s,value:c}),(0,n.createElement)(r.SelectControl,{label:(0,a.__)("Select writing tone","aiify"),onChange:e=>{window.aiify.tone=e,l(e)},options:d,value:i}),(0,n.createElement)(r.SelectControl,{label:(0,a.__)("Select an output language","aiify"),onChange:e=>{window.aiify.language=e,y(e)},options:g,value:h}))};return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(e,t),(0,n.createElement)(o.InspectorControls,null,(0,n.createElement)(r.PanelBody,{icon:_,title:(0,a.__)("Aiify Settings","aiify")},(0,n.createElement)(i,t))))}return(0,n.createElement)(e,t)}),"withPanelControl"),N=(window.wp.data,wp.data.select("core/block-editor").getSelectedBlock),I=e=>{const{attributes:t,name:n,innerBlocks:a=[]}=e,{content:o,level:r}=t||{};if(o)switch(n){case"core/heading":return`${"#".repeat(r)} ${o.replace(/\n+$/,"")}\n`;case"core/list-item":return`- ${o}\n`;case"core/citation":case"core/pullquote":return`> ${o}\n\n`;case"core/code":case"core/verse":return`\`\`\`\n${o}\n\`\`\`\n\n`;default:return`${o}\n\n`}return a.map(I).join("")},F=(0,M.createHigherOrderComponent)((e=>i=>{if(!y.includes(i.name))return(0,n.createElement)(e,i);const[l,c]=(0,n.useState)(!1),[s,d]=(0,n.useState)(!1),[u,p]=(0,n.useState)([]),m=()=>c(!1),g=async(e,t,n)=>{if(void 0===n&&(n=N()),n){d(!0);const a=I(n);B({idBlock:n.clientId,edit:a,prompt:e,setAttributes:()=>console.log,insertAfter:"edit"==t?null:t,onDone:()=>d(!1)})}},f=e=>{let{edits:t,command:o,onClose:i}=e;var l=[];return t.forEach((function(e){l.push({title:e,onClick:t=>{g(e,o),t()}})})),l.push({title:(0,a.__)("Custom edit","aiify"),onClick:e=>{p([o,N()]),c(!0),e()}}),(0,n.createElement)(n.Fragment,null,l.map((e=>(0,n.createElement)(r.MenuItem,{onClick:()=>e.onClick(i)},e.title))))},{attributes:w,setAttributes:h}=i,{edits:b,after:v,before:k}=window.aiify,E=(0,t.applyFilters)("aiify.customModal",(e=>(0,n.createElement)(n.Fragment,null,(0,n.createElement)("p",null,"Decouvrez la version pro"))));return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.BlockControls,{group:"block"},(0,n.createElement)(r.ToolbarGroup,null,(0,n.createElement)(r.ToolbarDropdownMenu,{icon:s?x:_,label:(0,a.__)("Aiify me","aiify")},(e=>{let{onClose:t}=e;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(r.MenuGroup,{label:(0,a.__)("Review or edit this block","aiify")},(0,n.createElement)(f,{edits:b,command:"edit",onClose:t})),(0,n.createElement)(r.MenuGroup,{label:(0,a.__)("Generate and prepend based on this block","aiify")},(0,n.createElement)(f,{edits:k,command:"before",onClose:t})),(0,n.createElement)(r.MenuGroup,{label:(0,a.__)("Generate and append based on this block","aiify")},(0,n.createElement)(f,{edits:v,command:"after",onClose:t})))})))),l&&(0,n.createElement)(r.Modal,{title:(0,a.__)("Custom command","aiify"),onRequestClose:m},(0,n.createElement)(E,{generateBlock:g,selectedEdit:u,closeModal:m})),(0,n.createElement)(e,i))}),"withToolbarButton");(0,e.registerBlockType)(S,{icon:{src:_},edit:function(e){let{attributes:t,setAttributes:i}=e;const l=(0,o.useBlockProps)(),[c,s]=(0,n.useState)(!1),{prompts:d}=window.aiify;var u=l.id.split("block-")[1];const p="prompt-"+u,m="context-"+u,g="keywords-"+u;return(0,n.createElement)("div",l,(0,n.createElement)(r.SelectControl,{label:(0,a.__)("Select a content type","aiify"),onChange:e=>{const t=e+' "['+d[e]+']"';i({prompt:t});const n=document.querySelector('[data-id="'+p+'"]');n&&setTimeout((()=>n.focus()),200)},options:(f=d,Object.keys(f).map(((e,t,n)=>({label:e,value:n[t]}))))}),(0,n.createElement)(r.TextareaControl,{"data-id":p,autoFocus:!0,placeholder:(0,a.__)("What do you want to write today?","aiify"),label:"",rows:2,value:t.prompt,onChange:e=>i({prompt:e}),onFocus:e=>{const t=e.target,n=t.value.match(/\"\[([^\]]+)\]\"/);if(n){const e=n.index+1,a=e+n[1].length+2;t.selectionStart=e,t.selectionEnd=a}}}),(0,n.createElement)(r.TextareaControl,{"data-id":m,placeholder:(0,a.__)("Add key information to include in the content?","aiify"),label:"",rows:4,value:t.context,onChange:e=>i({context:e})}),(0,n.createElement)(r.TextareaControl,{"data-id":g,placeholder:(0,a.__)("Add keywords to highlight in the content? (comma separated keywords)","aiify"),label:"",rows:1,value:t.keywords,onChange:e=>i({keywords:e})}),(0,n.createElement)(r.ButtonGroup,{textAlign:"right"},(0,n.createElement)(r.Button,{isBusy:c,disabled:c,variant:"primary",onClick:()=>{s(!0),B({prompt:t.prompt,context:t.context,keywords:t.keywords,idBlock:u,setAttributes:i,onDone:()=>s(!1)})},text:(0,a.__)("Write","aiify")}),(0,n.createElement)(r.Button,{disabled:c,variant:"default",onClick:()=>b(u),text:(0,a.__)("Clear","aiify")})),(0,n.createElement)(o.InnerBlocks,{allowedBlocks:["core/image","core/group","core/paragraph","core/quote","core/code","core/pullquote","core/list","core/list-item","core/heading","core/verse","wp-gb/inner-blocks"]}));var f},save:function(e){let{attributes:t}=e;return(0,n.createElement)("div",o.useBlockProps.save(),(0,n.createElement)(o.InnerBlocks.Content,null))},transforms:{from:[{type:"enter",regExp:/^ai$/i,transform:()=>w(S)}],to:[{type:"block",blocks:["core/group"],transform:(e,t)=>w("core/group",e,t)}]}}),(0,t.addFilter)("editor.BlockEdit","ai-panel",A),(0,t.addFilter)("editor.BlockEdit","ai-toolbar",F),(0,t.addFilter)("blocks.getBlockAttributes","paragraph_prompt",((e,t)=>("core/paragraph"==t.name&&(e.placeholder=window.aiify.paragraphPrompt),e)))})();