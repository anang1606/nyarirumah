(()=>{function e(e,t){for(var a=0;a<t.length;a++){var n=t[a];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var t=function(){function t(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t)}var a,n,o;return a=t,(n=[{key:"init",value:function(){$("#plugin-list").on("click",".btn-trigger-change-status",(function(e){e.preventDefault();var t=$(e.currentTarget);t.addClass("button-loading"),$.ajax({url:route("plugins.change.status",{name:t.data("plugin")}),type:"POST",data:{_method:"PUT"},success:function(e){e.error?Botble.showError(e.message):(Botble.showSuccess(e.message),$("#plugin-list #app-"+t.data("plugin")).load(window.location.href+" #plugin-list #app-"+t.data("plugin")+" > *"),window.location.reload()),t.removeClass("button-loading")},error:function(e){Botble.handleError(e),t.removeClass("button-loading")}})})),$(document).on("click",".btn-trigger-remove-plugin",(function(e){e.preventDefault(),$("#confirm-remove-plugin-button").data("plugin",$(e.currentTarget).data("plugin")),$("#remove-plugin-modal").modal("show")})),$(document).on("click","#confirm-remove-plugin-button",(function(e){e.preventDefault();var t=$(e.currentTarget);t.addClass("button-loading"),$.ajax({url:route("plugins.remove",{plugin:t.data("plugin")}),type:"POST",data:{_method:"DELETE"},success:function(e){e.error?Botble.showError(e.message):(Botble.showSuccess(e.message),window.location.reload()),t.removeClass("button-loading"),$("#remove-plugin-modal").modal("hide")},error:function(e){Botble.handleError(e),t.removeClass("button-loading"),$("#remove-plugin-modal").modal("hide")}})})),$(document).on("click",".btn-trigger-update-plugin",(function(e){e.preventDefault();var t=$(e.currentTarget),a=t.data("uuid");t.addClass("button-loading"),t.attr("disabled",!0),$.ajax({url:route("plugins.marketplace.ajax.update",{id:a}),type:"POST",success:function(e){e.error?(Botble.showError(e.message),t.removeClass("button-loading"),t.removeAttr("disabled",!0),e.data&&e.data.redirect&&window.location.href):(Botble.showSuccess(e.message),setTimeout((function(){window.location.reload()}),2e3))},error:function(e){Botble.handleError(e),t.removeClass("button-loading"),t.removeAttr("disabled",!0)}})})),this.checkUpdate()}},{key:"checkUpdate",value:function(){var e=this;$.ajax({url:route("plugins.marketplace.ajax.check-update"),type:"POST",success:function(t){t.data&&Object.keys(t.data).forEach((function(a){var n=t.data[a],o=$('[data-check-update="'+n.name+'"]');$checkVersion=e.checkVersion(o.data("version"),n.version),$checkVersion&&(o.attr("style","display: show;"),o.attr("data-uuid",n.id))}))}})}},{key:"checkVersion",value:function(e,t){for(var a=e.toString().split("."),n=t.toString().split("."),o=Math.max(a.length,n.length),r=0;r<o;r++){var i=~~a[r];if(~~n[r]>i)return!0}return!1}}])&&e(a.prototype,n),o&&e(a,o),Object.defineProperty(a,"prototype",{writable:!1}),t}();$(document).ready((function(){(new t).init()}))})();