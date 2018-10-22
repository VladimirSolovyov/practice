Vue.component('paginator', {
	props: {
		limit: Number,
		page: Number,
		count: Number,
		url: {
			type: String,
			default: ""
		},
		viewCount: {
			type: Number,
			default: 5
		},
		useRest: {
			type: Boolean,
			default: false
		},
		limitUrlName: {
			type: String,
			default: "limit"
		},
		pageUrlName: {
			type: String,
			default: "page"
		}
	},
	data: function () {
		return {
			itemClass: "paginator__item",
			itemClassActive: "paginator__item--active",
			showMany: true,
			showFirstView: false
		}
	},
	computed: {
		pages: function () {
			return Number.round(this.count / this.limit) - 1;
		},
		viewPages: function () {
			var arrViewPages = [];
			var start = 0;
			var end = this.pages;
			this.showMany = true;
			this.showFirstView = false;
			if (this.pages <= this.viewCount) {
				this.showMany = false;
			} else {
				var half = Number.floor(this.viewCount / 2);
				var diff = 0;
				if (this.page > half) {
					start = this.page - half;
					diff = (this.page + half) - this.pages;
					if (diff > 0) {
						start -= diff;
					}
					this.showFirstView = true;
				}
				end = start + this.viewCount;
				if (end >= this.pages) {
					this.showMany = false;
					diff = (end - this.pages);
					start -= diff;
					end -= diff;
				}
			}

			for (var i = start; i < end; i++) {
				arrViewPages.push(i + 1);
			}

			return arrViewPages;
		}
	},
	methods: {
		next: function () {
			this.page++;
		},
		prev: function () {
			this.page--;
		},
		removeUrlParams: function (url, paramsName) {
			var regex = new RegExp("([?;&])" + paramsName + "[^&;]*[;&]?");
			return url.replace(regex, "$1").replace(/&$/, '');
		},
		changeUrl: function () {

			var url = this.limitUrlName + "=" + this.limit;
			if (this.page) {
				url += "&" + this.pageUrlName + "=" + (this.page + 1);
			}
			var clearSearch = this.removeUrlParams(this.removeUrlParams(location.search, this.limitUrlName), this.pageUrlName);
			if (clearSearch == "" || clearSearch == "?") {
				url = "?" + url;
			} else {
				url = clearSearch + "&" + url;
			}

			if (this.useRest) {
				history.pushState(location.pathname, document.title, location.pathname + url);
			} else {
				location.href = location.pathname + url;
			}
		},
		update: function () {
			this.changeUrl();
			if (this.url == "" || !this.useRest) return;

			var resource = this.$resource(this.url);
			var self = this;
			resource.get({limit: this.limit, page: (this.page + 1)}).then(function (response) {
				self.$emit('update', {page: self.page, data: response.data});
			});
		},
		change: function (page) {
			if (page == this.page) return;
			this.page = page;
		}
	},
	watch: {
		limit: function (val) {
			this.update();
		},
		page: function (val) {
			this.update();
		}
	},
	created: function () {
		if (!this.useRest && this.url !== "") {
			this.useRest = true;
		}
	},
	template: `
<div class="paginator" v-if="pages > 0">
	<div v-if="page > 0 && pages > 0" @click="prev" class="paginator__item paginator__prev">prev</div>
	<div v-if="showFirstView" :class="itemClass" @click="change(0)">1</div>
	<div v-if="showFirstView" :class="itemClass">...</div>
	<div  v-for="viewPage in viewPages" :class="[itemClass, { [itemClassActive]: (viewPage-1)== page }]" @click="change(viewPage-1)">{{viewPage}}</div>
	<div v-if="showMany" :class="itemClass">...</div>
	<div :class="[itemClass, { [itemClassActive]: pages == page }]" @click="change(pages)">{{pages+1}}</div>
	<div v-if="page < pages" @click="next" class="paginator__item paginator__next">next</div>
</div>
	`
});