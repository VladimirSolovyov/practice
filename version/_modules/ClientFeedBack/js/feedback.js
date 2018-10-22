/**
 * Created by s.kostylev on 15.03.2017.
 */
var FeedBackModule = function (options) {

	this.feedbacks = options.feedbacks;
	this.commentsUrl = options.commentsUrl;
	this.canSwitch = options.canSwitch;
	this.feedBacksUrl = options.feedBacksUrl;
	this.limit = options.limit;
	this.page = options.page || 0;
	this.allFeedBacksCount = options.allFeedBacksCount;
	this.msg = options.msg;
	this.init();
};

FeedBackModule.prototype.init = function () {

	Vue.http.options.emulateJSON = true;
	var self = this;
	new Vue({
		el: '#feedbackModule',
		data: {
			feedBackClass: "feedback__item",
			feedBackClassDisable: "feedback__item--disable",
			limitsClass: "feedback__limit",
			limitsClassActive: "feedback__limit--active",
			feedBacks: self.feedbacks,
			commentsUrl: self.commentsUrl,
			url: self.feedBacksUrl,
			listUrl: self.feedBacksUrl + "/list",
			can_switch: self.canSwitch,
			addState: false,
			showMsgModerating: false,
			newFeedBack: {
				fb_name: "",
				fb_rating: "",
				fb_plus: "",
				fb_minus: "",
				fb_text: ""
			},
			limit: self.limit,
			page: self.page,
			limits: [10, 30, 50],
			allFeedBacksCount: self.allFeedBacksCount,
			msg: self.msg
		},
		methods: {
			switchActive: function (id) {
				var index = -1;
				for (var i = 0; i < this.feedBacks.length; i++) {
					if (this.feedBacks[i].fb_id == id) {
						index = i;
						break;
					}
				}
				if (index !== -1) {
					this.feedBacks[index].active = !this.feedBacks[index].active;

					var resource = this.$resource(this.url + '{/id}');
					var self = this;
					resource.update({id: id}, {'active': this.feedBacks[index].active}).then(function (response) {
						if (!response.data.status) {
							self.feedBacks[index].active = !self.feedBacks[index].active;
						}
					});
				}
			},
			saveFeedBack: function () {

				if (this.newFeedBack.fb_name.trim() == "") return;
				var resource = this.$resource(this.url + "/");
				var self = this;
				resource.save(this.newFeedBack).then(function (response) {
					if (response.data) {
						self.addState = false;
						for (var i  in self.newFeedBack) {
							self.newFeedBack[i] = "";
						}
						if (response.data.moderating) {
							self.showMsgModerating = true;
							setTimeout(function () {
								self.showMsgModerating = false;
							}, 7000);
						} else {
							self.page = 0;
						}
					}
				});
			},
			setRating: function (rating) {
				this.newFeedBack.fb_rating = rating;
			},
			updateFeedBacks: function (data) {
				this.page = data.page;
				this.feedBacks = data.data;
			},
			changeLimit: function (limit) {
				if (this.limit == limit) return;
				this.limit = limit;
				this.page = 0;
			}
		}
	});
};