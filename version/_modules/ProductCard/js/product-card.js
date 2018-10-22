/**
 * Created by s.kostylev on 15.03.2017.
 */
var ProductCardModule = function (options) {

	this.searchArticle = options.searchArticle;

	this.producers = options.producers;
	this.producersCount = options.producersCount;
	this.producersUrl = options.producersUrl;

	this.details = options.details;
	this.detailsCount = options.detailsCount;
	this.showProducer = options.showProducer;
	this.detailsUrl = options.detailsUrl;

	this.limit = options.limit;
	this.page = options.page || 0;
	this.state = options.state;

	this.init();
};

ProductCardModule.prototype.init = function () {

	Vue.http.options.emulateJSON = true;
	var id = "#productCardModule";

	var self = this;

	new Vue({
		el: "#productCardSearchModule",
		data: {
			article: self.searchArticle,
			disableSubmit: true,
			showError: false
		},
		methods: {
			check: function () {
				this.disableSubmit = !(this.article && this.article.length > 2);
			}
		},
		watch: {
			article: function (val) {
				this.check();
				this.showError = this.disableSubmit;
			}
		},
		created: function () {
			this.check();
		}
	});

	if (this.state == "producers") {
		new Vue({
			el: id,
			data: {
				producers: self.producers,
				producersCount: self.producersCount,
				page: self.page,
				limit: self.limit,
				url: self.producersUrl
			},
			methods: {
				updateProducers: function (data) {
					this.page = data.page;
					this.producers = data.data;
				}
			}
		});
	} else if (this.state == "details") {

		new Vue({
			el: id,
			data: {
				showProducer: self.showProducer,
				details: self.details,
				detailsCount: self.detailsCount,
				page: self.page,
				limit: self.limit,
				url: self.detailsUrl
			},
			methods: {
				updateDetails: function (data) {
					this.page = data.page;
					this.details = data.data;
				}
			}
		});
	}
};