(()=>{"use strict";const e=window.wp.blocks,t=window.wp.hooks,n=window.wp.element,a=window.wp.i18n,r=window.wp.blockEditor,o=window.wp.components,i=wp.data.select("core/block-editor"),l=wp.data.dispatch("core/block-editor"),c=i.getBlock,s=i.getBlockIndex,d=l.insertBlock,u=l.updateBlockAttributes,m=(l.updateBlock,i.getBlockRootClientId),p=(l.insertAfterBlock,l.insertBeforeBlock,l.removeBlocks),g=l.removeBlock,f=wp.blocks.switchToBlockType,w=wp.blocks.createBlock,h=wp.data.dispatch("core/notices").createErrorNotice,y=["core/paragraph","core/heading","core/group","core/code","core/pullquote","core/quote","core/verse","core/list","core/list-item"],b=e=>{p(c(e).innerBlocks.map((e=>e.clientId)))},v=e=>(e=(e=e.replace(/\[(.*?)\]\((.*?)\)/g,'<a href="$2">$1</a>')).replace(/\*\*(.*?)\*\*/g,"<strong>$1</strong>")).replace(/\*(.*?)\*/g,"<em>$1</em>"),E=function(e,t){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};switch(e){case"core/quote":case"core/pullquote":var a=t.split(" - ");a.length>1&&(n.citation=a.pop(),t=a.join(" - ")),n.value=v(t);break;default:n.content=v(t)}return w(e,n)},k=async(e,t,n,a)=>{var r=E(e,t.trimStart(),a);const o=c(n);o.innerBlocks;var i=o.innerBlocks?o.innerBlocks.length:0;return await d(r,i,n),await c(n).innerBlocks[i]},C=e=>"- "==e.slice(0,2)||"- "==e||"-"==e,B=e=>{let{idBlock:t,prompt:n,context:r,keywords:o,edit:i,setAttributes:l,insertAfter:p,onDone:y,isTiny:B=null,injectContent:_=null}=e;if(null==n)return;var x=new FormData;x.append("action","open_ai");const{style:S,tone:M,language:A,maxWords:N,nonce:I}=window.aiify;x.append("openai_nonce",I),x.append("style",S),x.append("tone",M),x.append("language",A),x.append("maxWords",N),i&&x.append("edit",i),x.append("prompt",n),r&&x.append("context",r),o&&x.append("keywords",o);var T=new URLSearchParams(x).toString(),F=new EventSource(window.ajaxurl+"?"+T),P=B?null:c(t),$=B?null:"core/group"==P.name||"core/list"==P.name,q="",D={},j=!1,G=!1,O=!1,W=!1,H="core/paragraph",R="",L=t,Z=!0,J=!0,z=!1,U=!1,V=!1,K=!1,Q=!1,X=null;const Y="after"==p;var ee=!0;const te=()=>{console.log("Answer completed",q),y&&y()};F.onmessage=async function(e){if(ee){ee=!1;const t=JSON.parse(e.data);if("messages"in t){var n=t.messages.map((e=>e.content)).join("\n\n");window.aiify.latestPrompt=n}return"prompt"in t&&(console.log("Prompt",t.prompt),window.aiify.latestPrompt=t.prompt),void("error"in t&&h(t.error.message,{type:"snackbar",explicitDismiss:!0}))}if("[DONE]"==e.data){if(F.close(),p)g(X.innerBlocks[0].clientId);else if(i)return"core/paragraph"!==H&&f(c(L),H),u(L,{content:v(R.trimStart()),name}),void te();return B?_(H,v(R),D):k(H,R,L,D),void te()}var r="";try{var o=JSON.parse(e.data);if("text"in o.choices[0])r=o.choices[0].text;else{if(!("content"in o.choices[0].delta))return;r=o.choices[0].delta.content}}catch(e){return}if(q+=r,!Z||(Z=!1,"\n\n"!=r&&""!=r)){if(i)if(p)0==Q&&(X=await async function(e,t,n,r){let o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{};var i=null;if("core/group"==e){const t=w("core/paragraph",{content:(0,a.__)("Please wait...","aiify")});i=w(e,{layout:{type:"constrained"},tagName:"div"},[t])}else if(t&&C(t)){e="core/list";var l=t.split("\n").map((e=>w("core/list-item",{content:e.substr(2)})));i=w(e,{},l)}else i=E(e,t.trimStart(),o);var c=s(n),u=m(n);return console.log("Block index  ",n,c),await d(i,r?c+1:c,u),i}("core/group",null,L,Y),L=t=X.clientId,Q=!0);else{if(!$)return"##"==r.slice(0,2)?(H="core/heading",void(D={level:r.length})):void(R+=r);0==K&&(b(t),K=!0)}0==j?(j=!0,D={},">"==r.slice(0,1)||"&gt;"==r.slice(0,4)?(H="core/pullquote",L=t,V=!0,U=!1,W=!1):"##"==r.slice(0,2)?(H="core/heading",L=t,U=!0,W=!1,V=!1,D={level:r.length}):C(r)?(0==W&&(W=!0,O=await k("core/list","",L),L=O.clientId,J=!0),z=!0,U=!1,V=!1,H="core/list-item"):(H="core/paragraph",L=t,W=!1,U=!1,V=!1)):"\n\n"!=r.slice(-2)&&"\n"!=r.slice(-1)||(G=!0),z||U||V?(z=!1,U=!1,V=!1):R+=r,G&&(W&&J?null==B?(c(O.clientId).innerBlocks[0].attributes.content=v(R.trimStart()),J=!1):_("core/list-item",v(R.trimStart()),{first:!0}):B?_(H,v(R),D):await k(H,R,L,D),R="",G=!1,j=!1),l({reply:q})}},F.onerror=function(e){F.close(),te()}},_=(0,n.createElement)("svg",{id:"Layer_1","data-name":"Layer 1",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 553.84 552.02"},(0,n.createElement)("path",{fill:"#6f52a2",d:"M.67,.18H371.96c99.34,0,180,80.66,180,180v371.29H180.67C81.32,551.47,.67,470.82,.67,371.47V.18H.67Z"}),(0,n.createElement)("g",null,(0,n.createElement)("path",{fill:"#fff",d:"M243.54,394.07c-23.45,0-43.15-8.03-59.11-24.1-15.96-16.07-23.94-35.83-23.94-59.28s7.98-43.15,23.94-59.11c15.96-15.96,35.66-23.94,59.11-23.94s43.2,7.98,59.28,23.94c16.06,15.96,24.1,35.66,24.1,59.11v60.9c0,6.52-2.07,11.78-6.19,15.8-4.13,4.01-9.45,6.02-15.96,6.02s-11.78-2.01-15.8-6.02c-4.02-4.02-6.02-9.28-6.02-15.8v-60.9c0-10.85-3.86-20.08-11.56-27.68-7.71-7.6-16.99-11.4-27.85-11.4s-20.08,3.8-27.68,11.4c-7.6,7.61-11.4,16.83-11.4,27.68s3.8,20.14,11.4,27.85c7.6,7.71,16.82,11.56,27.68,11.56,6.51,0,11.83,2.01,15.96,6.03,4.12,4.02,6.19,9.28,6.19,15.79s-2.07,11.84-6.19,15.96c-4.13,4.13-9.45,6.19-15.96,6.19Z"}),(0,n.createElement)("path",{fill:"#fff",d:"M385.37,165.93c5.32,5.33,7.98,11.68,7.98,19.06s-2.66,13.74-7.98,19.05c-5.32,5.32-11.67,7.98-19.05,7.98s-13.74-2.66-19.05-7.98c-5.32-5.32-7.98-11.67-7.98-19.05s2.66-13.73,7.98-19.06c5.32-5.32,11.67-7.98,19.05-7.98s13.73,2.66,19.05,7.98Zm3.09,83.54c0-14.54-7.38-21.82-22.15-21.82-6.52,0-11.78,2.01-15.8,6.02-4.02,4.02-6.03,9.28-6.03,15.79v122.13c0,6.52,2.01,11.78,6.03,15.8,4.01,4.01,9.28,6.02,15.8,6.02s11.83-2.01,15.96-6.02c4.12-4.02,6.19-9.28,6.19-15.8v-122.13Z"}))),x=(0,n.createElement)("svg",{width:"135",height:"140",viewBox:"0 0 135 140",xmlns:"http://www.w3.org/2000/svg",fill:"#fff"},(0,n.createElement)("rect",{y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.5s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.5s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"30",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.25s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.25s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"60",width:"15",height:"140",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"90",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.25s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.25s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"})),(0,n.createElement)("rect",{x:"120",y:"10",width:"15",height:"120",rx:"6"},(0,n.createElement)("animate",{attributeName:"height",begin:"0.5s",dur:"1s",values:"120;110;100;90;80;70;60;50;40;140;120",calcMode:"linear",repeatCount:"indefinite"}),(0,n.createElement)("animate",{attributeName:"y",begin:"0.5s",dur:"1s",values:"10;15;20;25;30;35;40;45;50;0;10",calcMode:"linear",repeatCount:"indefinite"}))),S="aiify/aiify",M=window.wp.compose,A=e=>{const{styles:t,tones:r,maxWords:i,style:l,tone:c,languages:s,language:d,latestPrompt:u}=window.aiify,[m,p]=(0,n.useState)(parseInt(i)),[g,f]=(0,n.useState)(c),[w,h]=(0,n.useState)(l),[y,b]=(0,n.useState)(d);return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.RangeControl,{min:0,max:2e3,label:(0,a.__)("Max words to generate","aiify"),help:(0,a.__)("Do not exceed this value","aiify"),value:parseInt(m),onChange:e=>{window.aiify.maxWords=e,p(e)}}),(0,n.createElement)(o.SelectControl,{label:(0,a.__)("Select writing style","aiify"),onChange:e=>{window.aiify.style=e,h(e)},options:t,value:w}),(0,n.createElement)(o.SelectControl,{label:(0,a.__)("Select writing tone","aiify"),onChange:e=>{window.aiify.tone=e,f(e)},options:r,value:g}),(0,n.createElement)(o.SelectControl,{label:(0,a.__)("Select an output language","aiify"),onChange:e=>{window.aiify.language=e,b(e)},options:s,value:y}))},N=(0,M.createHigherOrderComponent)((e=>t=>{const{name:i,attributes:l,setAttributes:c}=t;if((e=>y.concat(["aiify/aiify"]).includes(e))(i)&&t.isSelected){const{latestPrompt:i}=window.aiify;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(e,t),(0,n.createElement)(r.InspectorControls,null,(0,n.createElement)(o.PanelBody,{icon:_,title:(0,a.__)("Aiify Settings","aiify")},(0,n.createElement)(A,t),(0,n.createElement)(o.TextareaControl,{label:(0,a.__)("Last Prompt","aiify"),rows:10,value:i,disabled:!0}))))}return(0,n.createElement)(e,t)}),"withPanelControl"),I=(window.wp.data,wp.data.select("core/block-editor").getSelectedBlock),T=e=>{const{attributes:t,name:n,innerBlocks:a=[]}=e,{content:r,level:o}=t||{};if(r)switch(n){case"core/heading":return`${"#".repeat(o)} ${r.replace(/\n+$/,"")}\n`;case"core/list-item":return`- ${r}\n`;case"core/citation":case"core/pullquote":return`> ${r}\n\n`;case"core/code":case"core/verse":return`\`\`\`\n${r}\n\`\`\`\n\n`;default:return`${r}\n\n`}return a.map(T).join("")},F=(0,M.createHigherOrderComponent)((e=>i=>{if(!y.includes(i.name))return(0,n.createElement)(e,i);const[l,c]=(0,n.useState)(!1),[s,d]=(0,n.useState)(!1),[u,m]=(0,n.useState)([]),p=()=>c(!1),g=async(e,t,n)=>{if(void 0===n&&(n=I()),n){d(!0);const a=T(n);B({idBlock:n.clientId,edit:a,prompt:e,setAttributes:()=>console.log,insertAfter:"edit"==t?null:t,onDone:()=>d(!1)})}},f=e=>{let{edits:t,command:r,onClose:i}=e;var l=[];return t.forEach((function(e){l.push({title:e,onClick:t=>{g(e,r),t()}})})),l.push({title:(0,a.__)("Custom edit","aiify"),onClick:e=>{m([r,I()]),c(!0),e()}}),(0,n.createElement)(n.Fragment,null,l.map((e=>(0,n.createElement)(o.MenuItem,{onClick:()=>e.onClick(i)},e.title))))},{attributes:w,setAttributes:h}=i,{edits:b,after:v,before:E}=window.aiify,k=(0,t.applyFilters)("aiify.customModal",(e=>(0,n.createElement)(n.Fragment,null,(0,n.createElement)("p",null,"Decouvrez la version pro"))));return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(r.BlockControls,{group:"block"},(0,n.createElement)(o.ToolbarGroup,null,(0,n.createElement)(o.ToolbarDropdownMenu,{icon:s?x:_,label:(0,a.__)("Aiify me","aiify")},(e=>{let{onClose:t}=e;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.MenuGroup,{label:(0,a.__)("Review or edit this block","aiify")},(0,n.createElement)(f,{edits:b,command:"edit",onClose:t})),(0,n.createElement)(o.MenuGroup,{label:(0,a.__)("Generate and prepend based on this block","aiify")},(0,n.createElement)(f,{edits:E,command:"before",onClose:t})),(0,n.createElement)(o.MenuGroup,{label:(0,a.__)("Generate and append based on this block","aiify")},(0,n.createElement)(f,{edits:v,command:"after",onClose:t})))})))),l&&(0,n.createElement)(o.Modal,{title:(0,a.__)("Custom command","aiify"),onRequestClose:p},(0,n.createElement)(k,{generateBlock:g,selectedEdit:u,closeModal:p})),(0,n.createElement)(e,i))}),"withToolbarButton");(0,e.registerBlockType)(S,{icon:{src:_},edit:function(e){let{attributes:t,setAttributes:i,isTiny:l=null,injectContent:c=null,onDone:s=(()=>null)}=e;return function(e){const t=l?[]:(0,r.useBlockProps)(),[d,u]=(0,n.useState)(!1),{prompts:m}=window.aiify;if(l){var[e,p]=(0,n.useState)({});i=t=>{p({...e,...t})}}var g=l||t.id.split("block-")[1];const f="prompt-"+g,w="context-"+g,h="keywords-"+g,y=l?null:(0,n.createElement)(r.InnerBlocks,{allowedBlocks:["core/image","core/group","core/paragraph","core/quote","core/code","core/pullquote","core/list","core/list-item","core/heading","core/verse","wp-gb/inner-blocks"]}),v=l?null:(0,n.createElement)(o.Button,{disabled:d,variant:"default",onClick:()=>b(g),text:(0,a.__)("Clear","aiify")});return(0,n.createElement)("div",t,(0,n.createElement)(o.SelectControl,{label:(0,a.__)("Select a content type","aiify"),onChange:e=>{const t=e+' "['+m[e]+']"';i({prompt:t});const n=document.querySelector('[data-id="'+f+'"]');n&&setTimeout((()=>n.focus()),200),console.log()},options:(E=m,Object.keys(E).map(((e,t,n)=>({label:e,value:n[t]}))))}),(0,n.createElement)(o.TextareaControl,{"data-id":f,autoFocus:!0,placeholder:(0,a.__)("What do you want to write today?","aiify"),label:"",rows:2,value:e.prompt,onChange:e=>i({prompt:e}),onFocus:e=>{const t=e.target,n=t.value.match(/\"\[([^\]]+)\]\"/);if(n){const e=n.index+1,a=e+n[1].length+2;t.selectionStart=e,t.selectionEnd=a}}}),(0,n.createElement)(o.TextareaControl,{"data-id":w,placeholder:(0,a.__)("Add key information to include in the content?","aiify"),label:"",rows:4,value:e.context,onChange:e=>i({context:e})}),(0,n.createElement)(o.TextareaControl,{"data-id":h,placeholder:(0,a.__)("Add keywords to highlight in the content? (comma separated keywords)","aiify"),label:"",rows:1,value:e.keywords,onChange:e=>i({keywords:e})}),(0,n.createElement)(o.ButtonGroup,{textAlign:"right"},(0,n.createElement)(o.Button,{isBusy:d,disabled:d||null==e.prompt,variant:"primary",onClick:()=>{u(!0),B({prompt:e.prompt,context:e.context,keywords:e.keywords,idBlock:g,setAttributes:i,onDone:()=>{u(!1),s()},isTiny:l,injectContent:c})},text:(0,a.__)("Write","aiify")}),v),y);var E}(t)},save:function(e){let{attributes:t}=e;return(0,n.createElement)("div",r.useBlockProps.save(),(0,n.createElement)(r.InnerBlocks.Content,null))},transforms:{from:[{type:"enter",regExp:/^ai$/i,transform:()=>w(S)}],to:[{type:"block",blocks:["core/group"],transform:(e,t)=>w("core/group",e,t)}]}}),(0,t.addFilter)("editor.BlockEdit","ai-panel",N),(0,t.addFilter)("editor.BlockEdit","ai-toolbar",F),(0,t.addFilter)("blocks.getBlockAttributes","paragraph_prompt",((e,t)=>("core/paragraph"==t.name&&(e.placeholder=window.aiify.paragraphPrompt),e)))})();