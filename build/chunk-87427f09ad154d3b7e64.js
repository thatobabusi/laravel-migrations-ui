(window.webpackJsonp=window.webpackJsonp||[]).push([[2],{"1sRX":function(t,e,n){"use strict";var r=n("wHSu"),i={components:{FontAwesomeIcon:n("rT2p").a},computed:{faSpinner:function(){return r.d}}},a=n("KHd+"),s=Object(a.a)(i,(function(){var t=this.$createElement;return(this._self._c||t)("FontAwesomeIcon",{attrs:{icon:this.faSpinner,spin:""}})}),[],!1,null,null,null);e.a=s.exports},"2/hA":function(t,e,n){"use strict";n.r(e);var r=n("L2JU"),i=n("5iKg"),a=n("wKV1"),s=n("aQxf"),o=n("7LFa");function l(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function c(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var p={components:{MigrationsList:i.a,Navbar:a.a,TablesList:s.a},mixins:[o.a],mounted:function(){this.load()},methods:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?l(Object(n),!0).forEach((function(e){c(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(r.b)("migrations",["load"]),{refresh:function(){this.load()}}),metaInfo:{title:"Migrations"}},d=n("KHd+"),u=Object(d.a)(p,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("Navbar"),this._v(" "),e("div",{staticClass:"container-fluid"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-xl"},[e("MigrationsList")],1),this._v(" "),e("div",{staticClass:"col-xl-4"},[e("TablesList")],1)])])],1)}),[],!1,null,null,null);e.default=u.exports},"5iKg":function(t,e,n){"use strict";var r=n("wHSu"),i=n("rT2p"),a=n("3Zo4"),s=n("nqqA"),o=n("9HyH"),l=n("JhbM"),c=n("L2JU"),p=n("1sRX"),d={components:{Spinner:p.a,BDropdown:a.a,BDropdownItem:s.a,BDropdownDivider:o.a},data:function(){return{running:!1}}},u=n("KHd+"),m=Object(u.a)(d,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("BDropdown",{staticStyle:{width:"6.5em"},attrs:{right:"",size:"sm",split:"",variant:"warning"},scopedSlots:t._u([{key:"button-content",fn:function(){return[t.running?n("Spinner"):[t._v("Fresh")]]},proxy:!0}])},[t._v(" "),n("BDropdownItem",[t._v("\n        Fresh\n        "),n("small",{staticClass:"d-block text-muted"},[t._v("Drop tables & apply all migrations")])]),t._v(" "),n("BDropdownItem",[t._v("\n        Fresh + Seed "),n("small",{staticClass:"text-muted"},[t._v("(Default)")])]),t._v(" "),n("BDropdownDivider"),t._v(" "),n("BDropdownItem",[t._v("\n        Refresh\n        "),n("small",{staticClass:"d-block text-muted"},[t._v("Rollback & apply all migrations")])]),t._v(" "),n("BDropdownItem",[t._v("\n        Refresh + Seed\n    ")]),t._v(" "),n("BDropdownDivider"),t._v(" "),n("BDropdownItem",[t._v("\n        Seed only\n    ")])],1)}),[],!1,null,null,null).exports;function g(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function b(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var v={components:{Spinner:p.a,BDropdown:a.a,BDropdownItem:s.a,BDropdownDivider:o.a},props:{migration:{type:Object,required:!0}},computed:{variant:function(){return this.migration.isMissing?"secondary":this.migration.isApplied?"danger":"success"}},methods:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?g(Object(n),!0).forEach((function(e){b(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):g(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(c.b)("migrations",["runSingle"]),{applySingle:function(){return this.runSingle({name:this.migration.name,type:"apply"})},rollbackSingle:function(){return this.runSingle({name:this.migration.name,type:"rollback"})},runDefault:function(){this.migration.isMissing||(this.migration.isApplied?this.rollbackSingle():this.applySingle())}})},f=Object(u.a)(v,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("BDropdown",{staticStyle:{width:"6.5em"},attrs:{right:"",size:"sm",split:"",variant:t.variant},on:{click:t.runDefault},scopedSlots:t._u([{key:"button-content",fn:function(){return[t.migration.running?n("Spinner"):t.migration.isMissing?[t._v("Fix")]:t.migration.isApplied?[t._v("Rollback")]:[t._v("Apply")]]},proxy:!0}])},[t._v(" "),t.migration.isMissing?[n("BDropdownItem",[t._v("Recreate File")]),t._v(" "),n("BDropdownItem",[t._v("Update Filename")]),t._v(" "),n("BDropdownItem",[t._v("Delete Record")])]:t.migration.isApplied?[n("BDropdownItem",{on:{click:t.rollbackSingle}},[t._v("Rollback This Migration")]),t._v(" "),n("BDropdownItem",[t._v("Rollback Batch "+t._s(t.migration.batch))]),t._v(" "),n("BDropdownItem",[t._v("Rollback All")])]:[n("BDropdownItem",{on:{click:t.applySingle}},[t._v("Apply This Migration")]),t._v(" "),n("BDropdownItem",[t._v("Apply All Pending")])]],2)}),[],!1,null,null,null).exports;function h(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function _(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var w={components:{BDropdown:a.a,BDropdownItem:s.a,BDropdownDivider:o.a,RunButton:f,FontAwesomeIcon:i.a,FreshButton:m,Spinner:p.a},directives:{BTooltip:l.a},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?h(Object(n),!0).forEach((function(e){_(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):h(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(c.e)("migrations",["loading"]),{},Object(c.c)("migrations",{migrations:"getAllMigrations"}),{faQuestionCircle:function(){return r.c}})},y=Object(u.a)(w,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"card shadow-sm my-4"},[n("div",{staticClass:"card-header bg-secondary text-white",staticStyle:{"line-height":"1.2","padding-left":"0.80em","padding-right":"0.80em"}},[n("a",{staticClass:"float-right text-white",attrs:{href:"https://laravel.com/docs/migrations",target:"_blank"}},[n("FontAwesomeIcon",{attrs:{icon:t.faQuestionCircle}}),t._v("\n            Laravel Docs\n        ")],1),t._v(" "),n("h6",{staticClass:"m-0"},[t._v("\n            Migrations\n            "),t.loading?n("Spinner",{staticClass:"ml-1"}):t._e()],1)]),t._v(" "),n("table",{staticClass:"table table-hover bg-white mb-0"},[n("thead",[n("tr",[n("th",{attrs:{scope:"col"}},[t._v("Date / Time")]),t._v(" "),n("th",{attrs:{scope:"col"}},[t._v("Name")]),t._v(" "),n("th",{attrs:{scope:"col"}},[t._v("Status")]),t._v(" "),n("th",{staticClass:"align-middle font-weight-normal text-muted text-right",attrs:{scope:"col"}},[n("FreshButton")],1)])]),t._v(" "),t.migrations.length?n("tbody",t._l(t.migrations,(function(e){return n("tr",{key:e.name,class:e.isMissing?"table-danger":""},[n("td",{staticClass:"align-middle"},[e.date?n("span",[t._v(t._s(e.date))]):n("span",{staticClass:"text-muted"},[t._v("(Unknown)")])]),t._v(" "),n("td",{staticClass:"align-middle"},[n("span",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.right",value:e.relPath,expression:"migration.relPath",modifiers:{right:!0}}],staticClass:"pr-1"},[e.isMissing?[t._v("\n                            "+t._s(e.title)+"\n                            "),n("span",{staticClass:"badge badge-danger"},[t._v("File Missing!")])]:n("router-link",{attrs:{to:"/migration-details/"+e.name,"data-toggle":"modal","data-target":"#migration-popup","data-path":e.relPath}},[t._v("\n                            "+t._s(e.title)+"\n                        ")])],2)]),t._v(" "),n("td",{staticClass:"align-middle"},[e.isApplied?n("span",{staticClass:"badge badge-pill badge-success"},[t._v("Applied – Batch "+t._s(e.batch))]):n("span",{staticClass:"badge badge-pill badge-warning"},[t._v("Pending")])]),t._v(" "),n("td",{staticClass:"align-middle text-right"},[n("RunButton",{attrs:{migration:e}})],1)])})),0):t.loading?n("tbody",[n("tr",[n("td",{staticClass:"text-muted",attrs:{colspan:"4"}},[n("Spinner",{staticClass:"mr-2"}),t._v("\n                    Loading...\n                ")],1)])]):n("tbody",[t._m(0)])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("tr",[e("td",{attrs:{colspan:"4"}},[e("em",{staticClass:"text-muted"},[this._v("No migrations found.")])])])}],!1,null,null,null);e.a=y.exports},"7LFa":function(t,e,n){"use strict";e.a={mounted:function(){window.addEventListener("keydown",this.$_refresh_keyDown)},destroyed:function(){window.removeEventListener("keydown",this.$_refresh_keyDown)},methods:{$_refresh_keyDown:function(t){("F5"===t.code&&!t.ctrlKey||t.ctrlKey&&"KeyR"===t.code)&&(t.preventDefault(),this.refresh())}}}},aQxf:function(t,e,n){"use strict";var r=n("wHSu"),i=n("rT2p"),a=n("L2JU");function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var l={components:{Spinner:n("1sRX").a,FontAwesomeIcon:i.a},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(a.e)("migrations",["connection","database","loading","tables"]),{faPlug:function(){return r.b},faDatabase:function(){return r.a}})},c=n("KHd+"),p=Object(c.a)(l,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"card shadow-sm my-4"},[n("div",{staticClass:"card-header bg-secondary text-white",staticStyle:{"line-height":"1.2","padding-left":"0.80em","padding-right":"0.80em"}},[t.loading&&!t.database?n("span",{staticClass:"text-muted"},[n("Spinner",{staticClass:"mr-2"}),t._v("\n            Loading...\n        ")],1):[n("span",{staticStyle:{cursor:"default"},attrs:{"data-toggle":"tooltip","data-placement":"top",title:"Connection"}},[n("FontAwesomeIcon",{staticClass:"mr-1",attrs:{icon:t.faPlug}}),t._v("\n                "+t._s(t.connection)+"\n            ")],1),t._v(" "),n("span",{staticClass:"ml-3",staticStyle:{cursor:"default"},attrs:{"data-toggle":"tooltip","data-placement":"top",title:"Database"}},[n("FontAwesomeIcon",{staticClass:"mr-1",attrs:{icon:t.faDatabase}}),t._v("\n                "+t._s(t.database)+"\n            ")],1)]],2),t._v(" "),n("table",{staticClass:"table table-hover bg-white mb-0"},[n("thead",[n("tr",[n("th",{attrs:{scope:"col"}},[t._v("\n                    Tables\n                    "),t.loading?n("Spinner",{staticClass:"ml-1"}):t._e()],1)])]),t._v(" "),t.tables.length?n("tbody",t._l(t.tables,(function(e){return n("tr",[n("td",{staticClass:"align-middle"},[t._v("\n                    "+t._s(e)+"\n                ")])])})),0):t.loading?n("tbody",[n("tr",[n("td",{staticClass:"text-muted",attrs:{colspan:"4"}},[n("Spinner"),t._v("\n                    Loading...\n                ")],1)])]):n("tbody",[t._m(0)])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("tr",[e("td",{attrs:{colspan:"1"}},[e("em",{staticClass:"text-muted"},[this._v("No tables found.")])])])}],!1,null,null,null);e.a=p.exports}}]);
//# sourceMappingURL=chunk-87427f09ad154d3b7e64.js.map