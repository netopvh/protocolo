!function(e){function a(o){if(t[o])return t[o].exports;var n=t[o]={i:o,l:!1,exports:{}};return e[o].call(n.exports,n,n.exports,a),n.l=!0,n.exports}var t={};a.m=e,a.c=t,a.d=function(e,t,o){a.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:o})},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,a){return Object.prototype.hasOwnProperty.call(e,a)},a.p="",a(a.s=0)}({0:function(e,a,t){t("g5Ez"),t("G0Ww"),e.exports=t("9eX4")},"9eX4":function(e,a){var t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};!function(e){e.fn.ripple=function(a){if(this.length>1)return this.each(function(t,o){e(o).ripple(a)});if(a=a||{},this.off(".ripple").data("unbound",!0),a.unbind)return this;var o=function(){return m&&!m.data("unbound")};this.addClass("legitRipple").removeData("unbound").on("tap.ripple",function(a){o()||(m=e(this),y(a.coords))}).on("dragstart.ripple",function(e){g.allowDragging||e.preventDefault()}),e(document).on("move.ripple",function(e){o()&&w(e.coords)}).on("end.ripple",function(){o()&&C()}),e(window).on("scroll.ripple",function(e){o()&&C()});var n,i,s,r,l=function(e){return!!e.type.match(/^touch/)},d=function(e,a){return l(e)&&(e=c(e.originalEvent.touches,a)),[e.pageX,e.pageY]},c=function(a,t){return e.makeArray(a).filter(function(e,a){return e.identifier==t})[0]},p=0,u=function(e){"touchstart"==e.type&&(p=3),"scroll"==e.type&&(p=0);var a=p&&!l(e);return a&&p--,!a};this.on("mousedown.ripple touchstart.ripple",function(a){u(a)&&(n=l(a)?a.originalEvent.changedTouches[0].identifier:-1,i=e(this),s=e.Event("tap",{coords:d(a,n)}),~n?r=setTimeout(function(){i.trigger(s),r=null},g.touchDelay):i.trigger(s))}),e(document).on("mousemove.ripple touchmove.ripple mouseup.ripple touchend.ripple touchcancel.ripple",function(a){var t=a.type.match(/move/);r&&!t&&(clearTimeout(r),r=null,i.trigger(s)),u(a)&&(l(a)?c(a.originalEvent.changedTouches,n):!~n)&&e(this).trigger(t?e.Event("move",{coords:d(a,n)}):"end")}).on("contextmenu.ripple",function(e){u(e)}).on("touchmove",function(){clearTimeout(r),r=null});var m,b,h,f,g={},$=0,v=function(){var t={fixedPos:null,get dragging(){return!g.fixedPos},get adaptPos(){return g.dragging},get maxDiameter(){return Math.sqrt(Math.pow(h[0],2)+Math.pow(h[1],2))/m.outerWidth()*Math.ceil(g.adaptPos?100:200)+"%"},scaleMode:"fixed",template:null,allowDragging:!1,touchDelay:100,callback:null};e.each(t,function(e,t){g[e]=e in a?a[e]:t})},y=function(a){h=[m.outerWidth(),m.outerHeight()],v(),f=a,b=e("<span/>").addClass("legitRipple-ripple"),g.template&&b.append(("object"==t(g.template)?g.template:m.children(".legitRipple-template").last()).clone().removeClass("legitRipple-template")).addClass("legitRipple-custom"),b.appendTo(m),x(a,!1);var o=b.css("transition-duration").split(","),n=[parseFloat(o[0])+"s"].concat(o.slice(1)).join(",");b.css("transition-duration",n).css("width",g.maxDiameter),b.on("transitionend webkitTransitionEnd oTransitionEnd",function(){e(this).data("oneEnded")?e(this).off().remove():e(this).data("oneEnded",!0)})},w=function(e){var a;if($++,"proportional"===g.scaleMode){var t=Math.pow($,$/100*.6);a=t>40?40:t}else if("fixed"==g.scaleMode&&Math.abs(e[1]-f[1])>6)return void C();x(e,a)},C=function(){b.css("width",b.css("width")).css("transition","none").css("transition","").css("width",b.css("width")).css("width",g.maxDiameter).css("opacity","0"),m=null,$=0},x=function(a,t){var o=[],n=!0===g.fixedPos?[.5,.5]:[(g.fixedPos?g.fixedPos[0]:a[0]-m.offset().left)/h[0],(g.fixedPos?g.fixedPos[1]:a[1]-m.offset().top)/h[1]],i=[.5-n[0],.5-n[1]],s=[100/parseFloat(g.maxDiameter),100/parseFloat(g.maxDiameter)*(h[1]/h[0])],r=[i[0]*s[0],i[1]*s[1]],l=g.dragging||0===$;if(l&&"inline"==m.css("display")){var d=e("<span/>").text("Hi!").css("font-size",0).prependTo(m),c=d.offset().left;d.remove(),o=[a[0]-c+"px",a[1]-m.offset().top+"px"]}l&&b.css("left",o[0]||100*n[0]+"%").css("top",o[1]||100*n[1]+"%"),b.css("transform","translate3d(-50%, -50%, 0)"+(g.adaptPos?"translate3d("+100*r[0]+"%, "+100*r[1]+"%, 0)":"")+(t?"scale("+t+")":"")),g.callback&&g.callback(m,b,n,g.maxDiameter)};return this},e.ripple=function(a){e.each(a,function(a,t){e(a).ripple(t)})},e.ripple.destroy=function(){e(".legitRipple").removeClass("legitRipple").add(window).add(document).off(".ripple"),e(".legitRipple-ripple").remove()}}(jQuery),$(function(){$(".btn:not(.disabled):not(.multiselect.btn-default):not(.bootstrap-select .btn-default):not(.file-drag-handle), .navigation li:not(.disabled) a, .nav > li:not(.disabled) > a, .sidebar-user-material-menu > a, .sidebar-user-material-content > a, .select2-selection--single[class*=bg-], .breadcrumb-elements > li:not(.disabled) > a, .wizard > .actions a, .ui-button:not(.ui-dialog-titlebar-close), .ui-tabs-anchor:not(.ui-state-disabled), .plupload_button:not(.plupload_disabled), .fc-button, .pagination > li:not(.disabled) > a, .pagination > li:not(.disabled) > span, .pager > li:not(.disabled) > a, .pager > li:not(.disabled) > span").ripple({dragging:!1,adaptPos:!1,scaleMode:!1}),$(".dp-item, .dp-nav, .sidebar-xs .sidebar-main .navigation > li > a").ripple({unbind:!0}),$(document).on("click",".sidebar-control",function(){$("body").hasClass("sidebar-xs")?$(".sidebar-main .navigation > li > a").ripple({unbind:!0}):$(".sidebar-main .navigation > li > a").ripple({unbind:!1})})})},G0Ww:function(e,a){$(function(){function e(){$("body").hasClass("sidebar-xs")&&$(".sidebar-main.sidebar-fixed .sidebar-content").on("mouseenter",function(){$("body").hasClass("sidebar-xs")&&$("body").removeClass("sidebar-xs").addClass("sidebar-fixed-expanded")}).on("mouseleave",function(){$("body").hasClass("sidebar-fixed-expanded")&&$("body").removeClass("sidebar-fixed-expanded").addClass("sidebar-xs")})}function a(){$(".sidebar-fixed .sidebar-content").niceScroll({mousescrollstep:100,cursorcolor:"#ccc",cursorborder:"",cursorwidth:3,hidecursordelay:100,autohidemode:"scroll",horizrailenabled:!1,preservenativescrolling:!1,railpadding:{right:.5,top:1.5,bottom:1.5}})}function t(){$(".sidebar-fixed .sidebar-content").getNiceScroll().remove(),$(".sidebar-fixed .sidebar-content").removeAttr("style").removeAttr("tabindex")}e(),$(".sidebar-main-toggle").on("click",function(a){e()}),a(),$(window).on("resize",function(){setTimeout(function(){$(window).width()<=768?t():a()},100)}).resize()})},g5Ez:function(e,a){$(window).on("load",function(){$("body").removeClass("no-transitions")}),$(function(){function e(){var e=$(window).height()-$(".page-container").offset().top-$(".navbar-fixed-bottom").outerHeight();$(".page-container").attr("style","min-height:"+e+"px")}function a(){$.ajax({url:"/dashboard/tramitacao/counters",type:"GET",success:function(e){$("#setor").html(e.noSetor),$("#pendente").html(e.pendentes),$("#arquivado").html(e.arquivado)}})}$("body").addClass("no-transitions"),e(),$(".panel-footer").has("> .heading-elements:not(.not-collapsible)").prepend('<a class="heading-elements-toggle"><i class="icon-more"></i></a>'),$(".page-title, .panel-title").parent().has("> .heading-elements:not(.not-collapsible)").children(".page-title, .panel-title").append('<a class="heading-elements-toggle"><i class="icon-more"></i></a>'),$(".page-title .heading-elements-toggle, .panel-title .heading-elements-toggle").on("click",function(){$(this).parent().parent().toggleClass("has-visible-elements").children(".heading-elements").toggleClass("visible-elements")}),$(".panel-footer .heading-elements-toggle").on("click",function(){$(this).parent().toggleClass("has-visible-elements").children(".heading-elements").toggleClass("visible-elements")}),$(".breadcrumb-line").has(".breadcrumb-elements").prepend('<a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>'),$(".breadcrumb-elements-toggle").on("click",function(){$(this).parent().children(".breadcrumb-elements").toggleClass("visible-elements")}),$(document).on("click",".dropdown-content",function(e){e.stopPropagation()}),$(".navbar-nav .disabled a").on("click",function(e){e.preventDefault(),e.stopPropagation()}),$('.dropdown-content a[data-toggle="tab"]').on("click",function(e){$(this).tab("show")}),$(".panel [data-action=reload]").click(function(e){e.preventDefault();var a=$(this).parent().parent().parent().parent().parent();$(a).block({message:'<i class="icon-spinner2 spinner"></i>',overlayCSS:{backgroundColor:"#fff",opacity:.8,cursor:"wait","box-shadow":"0 0 0 1px #ddd"},css:{border:0,padding:0,backgroundColor:"none"}}),window.setTimeout(function(){$(a).unblock()},2e3)}),$(".category-title [data-action=reload]").click(function(e){e.preventDefault();var a=$(this).parent().parent().parent().parent();$(a).block({message:'<i class="icon-spinner2 spinner"></i>',overlayCSS:{backgroundColor:"#000",opacity:.5,cursor:"wait","box-shadow":"0 0 0 1px #000"},css:{border:0,padding:0,backgroundColor:"none",color:"#fff"}}),window.setTimeout(function(){$(a).unblock()},2e3)}),$(".sidebar-default .category-title [data-action=reload]").click(function(e){e.preventDefault();var a=$(this).parent().parent().parent().parent();$(a).block({message:'<i class="icon-spinner2 spinner"></i>',overlayCSS:{backgroundColor:"#fff",opacity:.8,cursor:"wait","box-shadow":"0 0 0 1px #ddd"},css:{border:0,padding:0,backgroundColor:"none"}}),window.setTimeout(function(){$(a).unblock()},2e3)}),$(".category-collapsed").children(".category-content").hide(),$(".category-collapsed").find("[data-action=collapse]").addClass("rotate-180"),$(".category-title [data-action=collapse]").click(function(a){a.preventDefault();var t=$(this).parent().parent().parent().nextAll();$(this).parents(".category-title").toggleClass("category-collapsed"),$(this).toggleClass("rotate-180"),e(),t.slideToggle(150)}),$(".panel-collapsed").children(".panel-heading").nextAll().hide(),$(".panel-collapsed").find("[data-action=collapse]").addClass("rotate-180"),$(".panel [data-action=collapse]").click(function(a){a.preventDefault();var t=$(this).parent().parent().parent().parent().nextAll();$(this).parents(".panel").toggleClass("panel-collapsed"),$(this).toggleClass("rotate-180"),e(),t.slideToggle(150)}),$(".panel [data-action=close]").click(function(a){a.preventDefault();var t=$(this).parent().parent().parent().parent().parent();e(),t.slideUp(150,function(){$(this).remove()})}),$(".category-title [data-action=close]").click(function(a){a.preventDefault();var t=$(this).parent().parent().parent().parent();e(),t.slideUp(150,function(){$(this).remove()})}),$(".navigation").find("li.active").parents("li").addClass("active"),$(".navigation").find("li").not(".active, .category-title").has("ul").children("ul").addClass("hidden-ul"),$(".navigation").find("li").has("ul").children("a").addClass("has-ul"),$(".dropdown-menu:not(.dropdown-content), .dropdown-menu:not(.dropdown-content) .dropdown-submenu").has("li.active").addClass("active").parents(".navbar-nav .dropdown:not(.language-switch), .navbar-nav .dropup:not(.language-switch)").addClass("active"),$(".navigation-main > .navigation-header > i").tooltip({placement:"right",container:"body"}),$(".navigation-main").find("li").has("ul").children("a").on("click",function(e){e.preventDefault(),$(this).parent("li").not(".disabled").not($(".sidebar-xs").not(".sidebar-xs-indicator").find(".navigation-main").children("li")).toggleClass("active").children("ul").slideToggle(250),$(".navigation-main").hasClass("navigation-accordion")&&$(this).parent("li").not(".disabled").not($(".sidebar-xs").not(".sidebar-xs-indicator").find(".navigation-main").children("li")).siblings(":has(.has-ul)").removeClass("active").children("ul").slideUp(250)}),$(".navigation-alt").find("li").has("ul").children("a").on("click",function(e){e.preventDefault(),$(this).parent("li").not(".disabled").toggleClass("active").children("ul").slideToggle(200),$(".navigation-alt").hasClass("navigation-accordion")&&$(this).parent("li").not(".disabled").siblings(":has(.has-ul)").removeClass("active").children("ul").slideUp(200)}),$(".sidebar-main-toggle").on("click",function(e){e.preventDefault(),$("body").toggleClass("sidebar-xs")}),$(document).on("click",".navigation .disabled a",function(e){e.preventDefault()}),$(document).on("click",".sidebar-control",function(a){e()}),$(document).on("click",".sidebar-main-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-main-hidden")}),$(document).on("click",".sidebar-secondary-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-secondary-hidden")}),$(document).on("click",".sidebar-detached-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-detached-hidden")}),$(document).on("click",".sidebar-all-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-all-hidden")}),$(document).on("click",".sidebar-opposite-toggle",function(e){e.preventDefault(),$("body").toggleClass("sidebar-opposite-visible"),$("body").hasClass("sidebar-opposite-visible")?($("body").addClass("sidebar-xs"),$(".navigation-main").children("li").children("ul").css("display","")):$("body").removeClass("sidebar-xs")}),$(document).on("click",".sidebar-opposite-main-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-opposite-visible"),$("body").hasClass("sidebar-opposite-visible")?$("body").addClass("sidebar-main-hidden"):$("body").removeClass("sidebar-main-hidden")}),$(document).on("click",".sidebar-opposite-secondary-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-opposite-visible"),$("body").hasClass("sidebar-opposite-visible")?$("body").addClass("sidebar-secondary-hidden"):$("body").removeClass("sidebar-secondary-hidden")}),$(document).on("click",".sidebar-opposite-hide",function(e){e.preventDefault(),$("body").toggleClass("sidebar-all-hidden"),$("body").hasClass("sidebar-all-hidden")?($("body").addClass("sidebar-opposite-visible"),$(".navigation-main").children("li").children("ul").css("display","")):$("body").removeClass("sidebar-opposite-visible")}),$(document).on("click",".sidebar-opposite-fix",function(e){e.preventDefault(),$("body").toggleClass("sidebar-opposite-visible")}),$(".sidebar-mobile-main-toggle").on("click",function(e){e.preventDefault(),$("body").toggleClass("sidebar-mobile-main").removeClass("sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached")}),$(".sidebar-mobile-secondary-toggle").on("click",function(e){e.preventDefault(),$("body").toggleClass("sidebar-mobile-secondary").removeClass("sidebar-mobile-main sidebar-mobile-opposite sidebar-mobile-detached")}),$(".sidebar-mobile-opposite-toggle").on("click",function(e){e.preventDefault(),$("body").toggleClass("sidebar-mobile-opposite").removeClass("sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached")}),$(".sidebar-mobile-detached-toggle").on("click",function(e){e.preventDefault(),$("body").toggleClass("sidebar-mobile-detached").removeClass("sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-opposite")}),$(window).on("resize",function(){setTimeout(function(){e(),$(window).width()<=768?($("body").addClass("sidebar-xs-indicator"),$(".sidebar-opposite").insertBefore(".content-wrapper"),$(".sidebar-detached").insertBefore(".content-wrapper"),$(".dropdown-submenu").on("mouseenter",function(){$(this).children(".dropdown-menu").addClass("show")}).on("mouseleave",function(){$(this).children(".dropdown-menu").removeClass("show")})):($("body").removeClass("sidebar-xs-indicator"),$(".sidebar-opposite").insertAfter(".content-wrapper"),$("body").removeClass("sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached sidebar-mobile-opposite"),$("body").hasClass("has-detached-left")?$(".sidebar-detached").insertBefore(".container-detached"):$("body").hasClass("has-detached-right")&&$(".sidebar-detached").insertAfter(".container-detached"),$(".page-header-content, .panel-heading, .panel-footer").removeClass("has-visible-elements"),$(".heading-elements").removeClass("visible-elements"),$(".dropdown-submenu").children(".dropdown-menu").removeClass("show"))},100)}).resize(),$('[data-popup="popover"]').popover(),$('[data-popup="tooltip"]').tooltip(),$(".select").select2({minimumResultsForSearch:1/0}),$(".select-search").select2(),$(".styled, .multiselect-container input").uniform({radioClass:"choice"}),$(".datepicker").datepicker({format:"dd/mm/yyyy",autoclose:!0,language:"pt-BR"}),$(".file-styled-primary").uniform({fileButtonClass:"action btn bg-blue",fileButtonHtml:"Selecione os Arquivos",fileDefaultHtml:"Nenhum arquivo foi selecionado"}),$(".control-primary").uniform({radioClass:"choice",wrapperClass:"border-primary-600 text-primary-800"}),$(".control-danger").uniform({radioClass:"choice",wrapperClass:"border-danger-600 text-danger-800"}),$(".control-success").uniform({radioClass:"choice",wrapperClass:"border-success-600 text-success-800"}),$(".control-warning").uniform({radioClass:"choice",wrapperClass:"border-warning-600 text-warning-800"}),$(".control-info").uniform({radioClass:"choice",wrapperClass:"border-info-600 text-info-800"}),$(".file-styled").uniform({fileButtonClass:"action btn bg-blue"}),Array.prototype.slice.call(document.querySelectorAll(".switchery")).forEach(function(e){new Switchery(e)}),$('table[data-form="deleteForm"]').on("click",".form-delete",function(e){e.preventDefault();var a=$(this);$("#confirm").modal({backdrop:"static",keyboard:!1}).on("click","#delete-btn",function(){a.submit()})}),$(".listbox").bootstrapDualListbox({nonSelectedListLabel:"Todas Permissões",selectedListLabel:"Permissões Selecionadas",filterPlaceHolder:"Pesquisar",moveAllLabel:"Mover Tudo",removeAllLabel:"Remover Tudo",infoText:"Mostrando todos os {0}",infoTextEmpty:"Lista Vazia"}),$(".listbox-no-selection").bootstrapDualListbox({preserveSelectionOnMove:"moved",moveOnSelect:!1});var t=$(".form-validate-jquery").validate({ignore:"input[type=hidden], .select2-search__field",errorClass:"validation-error-label",successClass:"validation-valid-label",highlight:function(e,a){$(e).removeClass(a)},unhighlight:function(e,a){$(e).removeClass(a)},errorPlacement:function(e,a){a.parents("div").hasClass("checker")||a.parents("div").hasClass("choice")||a.parent().hasClass("bootstrap-switch-container")?a.parents("label").hasClass("checkbox-inline")||a.parents("label").hasClass("radio-inline")?e.appendTo(a.parent().parent().parent().parent()):e.appendTo(a.parent().parent().parent().parent().parent()):a.parents("div").hasClass("checkbox")||a.parents("div").hasClass("radio")?e.appendTo(a.parent().parent().parent()):a.parents("div").hasClass("has-feedback")||a.hasClass("select2-hidden-accessible")?e.appendTo(a.parent()):a.parents("label").hasClass("checkbox-inline")||a.parents("label").hasClass("radio-inline")?e.appendTo(a.parent().parent()):a.parent().hasClass("uploader")||a.parents().hasClass("input-group")?e.appendTo(a.parent().parent()):e.insertAfter(a)},validClass:"validation-valid-label",rules:{password:{minlength:5},repeat_password:{equalTo:"#password"},email:{email:!0},repeat_email:{equalTo:"#email"},minimum_characters:{minlength:10},maximum_characters:{maxlength:10},minimum_number:{min:10},maximum_number:{max:10},number_range:{range:[10,20]},url:{url:!0},date:{date:!0},date_iso:{dateISO:!0},numbers:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0},basic_checkbox:{minlength:2},styled_checkbox:{minlength:2},switchery_group:{minlength:2},switch_group:{minlength:2},documentos:{required:!0,extension:"pdf|doc|docx"}}});$("#reset").on("click",function(){t.resetForm()}),$(".textarea").ckeditor(),$(".upper").bind("keyup",function(e){if(e.which>=97&&e.which<=122){var a=e.which-32;e.keyCode=a,e.charCode=a}$(".upper").val($(".upper").val().toUpperCase())}),$('a[data-toggle="tab"]').on("shown.bs.tab",function(e){$($.fn.dataTable.tables(!0)).css("width","100%"),$($.fn.dataTable.tables(!0)).DataTable().columns.adjust().draw()});var o={sEmptyTable:"Nenhum registro encontrado",sInfo:"Mostrando de _START_ até _END_ de _TOTAL_ registros",sInfoEmpty:"Mostrando 0 até 0 de 0 registros",sInfoFiltered:"(Filtrados de _MAX_ registros)",sInfoPostFix:"",sInfoThousands:".",sLengthMenu:"_MENU_ resultados por página",sLoadingRecords:"Carregando...",sProcessing:"Processando...",sZeroRecords:"Nenhum registro encontrado",sSearch:"Pesquisar",oPaginate:{sNext:"Próximo",sPrevious:"Anterior",sFirst:"Primeiro",sLast:"Último"},oAria:{sSortAscending:": Ordenar colunas de forma ascendente",sSortDescending:": Ordenar colunas de forma descendente"}},n=$("#tbl_departamento");n.length&&n.DataTable({serverSide:!0,processing:!0,language:o,ajax:"/dashboard/departamento/data",columns:[{data:"id",width:"30px"},{data:"descricao"},{data:"action",orderable:!1,searchable:!1,width:"115px"}]});var i=$("#tbl_tp_documento");i.length&&i.DataTable({serverSide:!0,processing:!0,language:o,ajax:"/dashboard/tipodoc/data",columns:[{data:"id",width:"30px"},{data:"descricao"},{data:"action",orderable:!1,searchable:!1,width:"115px"}]});var s=$("#tbl_documento");if(s.length){a();var r=s.DataTable({dom:"<'row'<'col-xs-12'<'col-xs-12'>>r><'row'<'col-xs-12't>><'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",serverSide:!0,processing:!0,responsive:!0,language:o,ajax:{url:"/dashboard/tramitacao/data",data:function(e){e.numero=$("#numero").val(),e.ano=$("#ano").val(),e.id_tipo_doc=$("#id_tipo_doc").val()}},columns:[{data:"numero",name:"documentos.numero",width:"80px"},{data:"assunto",name:"documentos.assunto"},{data:"tipo",name:"tipo_documentos.descricao"},{data:"origem"},{data:"data_doc",name:"documentos.data_doc",width:"180px"},{data:"action",orderable:!1,searchable:!1,width:"140px"}]});$("#search-form").on("submit",function(e){r.draw(),e.preventDefault()})}var l=$("#tbl_doc_pendentes");if(l.length){var d=l.DataTable({dom:"<'row'<'col-xs-12'<'col-xs-12'>>r><'row'<'col-xs-12't>><'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",serverSide:!0,processing:!0,responsive:!0,language:o,ajax:{url:"/dashboard/tramitacao/pendente",data:function(e){e.numero=$("#numeroPendete").val(),e.ano=$("#anoPendente").val()}},columns:[{data:"numero",name:"documentos.numero",width:"80px"},{data:"assunto",name:"documentos.assunto"},{data:"tipo",name:"tipo_documentos.descricao"},{data:"origem"},{data:"data_doc",name:"documentos.data_doc",width:"180px"},{data:"action",orderable:!1,searchable:!1,width:"130px"}]});$("#search-form-pend").on("submit",function(e){d.draw(),e.preventDefault()});var c=$('table[data-form="recebePendente"]'),p=$(".modal-title");$(".modal-body");c.on("click",".receber",function(e){e.preventDefault(),p.html(""),p.html("Recebimento de documentos"),$("#title-modal").show(),$(".despacho").hide();var t={_token:$('meta[name="csrf-token"]').attr("content"),id:$(this).data("id"),action:"R"};$("#confirm").modal({backdrop:"static",keyboard:!1}).on("click","#confirm-btn",function(){$.ajax({url:"/dashboard/tramitacao/action",type:"POST",data:t,dataType:"json",success:function(){d.draw(),$("#confirm").modal("hide"),a()}})})}),c.on("click",".devolver",function(e){var t=$(this).data("id");e.preventDefault(),p.html(""),p.html("Devolução de documentos"),$("#title-modal").hide(),$(".despacho").show(),$("#confirm").modal({backdrop:"static",keyboard:!1}).on("click","#confirm-btn",function(){var e=CKEDITOR.instances.editor.getData();$.ajax({url:"/dashboard/tramitacao/action",type:"POST",data:{_token:$('meta[name="csrf-token"]').attr("content"),id:t,despacho:e,action:"D"},dataType:"json",success:function(){d.draw(),$("#confirm").modal("hide"),a()}})})})}if($("#despacho").on("click",function(){alert($(this).data("id"))}),$("#form_documento").length){$("input:radio[name=int_ext]").change(function(){"I"===this.value?($("#tipodoc").collapse("hide"),$("#setdep").collapse("show"),$("#orgsec").collapse("hide"),$("select[name=id_departamento]").prop("required",!0),$("input:radio[name=tipo_tram]").prop("required",!1),$("select[name=id_secretaria]").prop("required",!1)):"E"===this.value&&($("#tipodoc").collapse("show"),$("#setdep").collapse("hide"),$("#orgsec").collapse("hide"),$("select[name=id_departamento]").prop("required",!1),$("input:radio[name=tipo_tram]").prop("required",!0),$("select[name=id_secretaria]").prop("required",!1))}),"I"===$("input:radio[name=int_ext]:checked").val()?($("#tipodoc").collapse("hide"),$("#setdep").collapse("show"),$("#orgsec").collapse("hide"),$("select[name=id_departamento]").prop("required",!0),$("input:radio[name=tipo_tram]").prop("required",!1),$("select[name=id_secretaria]").prop("required",!1)):"E"===$("input:radio[name=int_ext]:checked").val()&&($("#tipodoc").collapse("show"),$("#setdep").collapse("hide"),$("#orgsec").collapse("hide"),$("select[name=id_departamento]").prop("required",!1),$("input:radio[name=tipo_tram]").prop("required",!0),$("select[name=id_secretaria]").prop("required",!1)),$("input:radio[name=tipo_tram]").change(function(){"C"===this.value?($("#setdep").collapse("show"),$("#orgsec").collapse("show"),$("#setdep").insertAfter("#orgsec"),$("select[name=id_departamento]").prop("required",!0),$("select[name=id_secretaria]").prop("required",!1)):"S"===this.value&&($("#setdep").collapse("show"),$("#orgsec").collapse("show"),$("#orgsec").insertAfter("#setdep"),$("select[name=id_departamento]").prop("required",!1),$("select[name=id_secretaria]").prop("required",!1))}),"C"===$("input:radio[name=tipo_tram]:checked").val()?($("#setdep").collapse("show"),$("#orgsec").collapse("show"),$("select[name=id_departamento]").prop("required",!0),$("select[name=id_secretaria]").prop("required",!1)):"S"===$("input:radio[name=int_ext]:checked").val()&&($("#setdep").collapse("show"),$("#orgsec").collapse("show"),$("select[name=id_departamento]").prop("required",!1),$("select[name=id_secretaria]").prop("required",!1));var u=$("#btn_tramitacao");$("#form_documento").submit(function(){t.numberOfInvalids()<1&&u.prop("disabled",!0)})}$("#filter-form").on("submit",function(e){e.preventDefault(),$.ajax({url:"/dashboard/tramitacao/consulta",type:"GET",data:$(this).serialize(),dataType:"json",success:function(e){$("#ajaxResponse").append(e)}})})})}});