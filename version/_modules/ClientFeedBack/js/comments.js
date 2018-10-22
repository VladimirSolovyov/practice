Vue.component('comments', {
	props: [
		'id',
		'can_add',
		'can_switch',
		'count',
		'url',
		'msg'
	],
	data: function () {
		return {
			showComments: false,
			newComment: "",
			comments: [],
			isEmpty: false
		}
	},
	created: function () {
		this.isEmpty = this.count < 1;
	},
	methods: {
		addComment: function () {

			if (this.newComment.trim() == "") return;

			var resource = this.$resource(this.url + '{/id}');
			var self = this;
			resource.save({id: this.id}, {text: this.newComment}).then(function (response) {
				if (response.data) {

					self.comments.push({
						username: self.msg.i,
						text: self.newComment,
						datetime: response.data.datetime,
						active: 1
					});
					self.newComment = "";
					self.count++;
				} else {

				}
			});
		},
		switchCommentBlock: function () {
			this.showComments = !this.showComments;
			if (this.comments.length > 0 || this.isEmpty) return;

			var resource = this.$resource(this.url + '{/id}');
			var self = this;
			resource.get({id: this.id}).then(function (response) {
				self.comments = response.data;
			});
		}
	},
	watch: {
		id: function (val) {
			this.showComments = false;
			this.comments = [];
		}
	},
	template: `<div class="comments">
				<span @click="switchCommentBlock" class="comments__header">
					<span v-if="showComments">{{msg.hideComments}}</span>
					<span v-else>
						<span v-if="count > 0">{{msg.comments}} ({{ count }})</span>
						<span v-else-if="can_add">{{msg.commenting}}</span>
					</span>
					</span>
				<div v-show="showComments" class="comments__form">
					<div class="comments__list">
						<comment v-for="comment in comments" :data="comment" :url="url" :can_switch="can_switch" :msg="msg"></comment>
					</div>
					<div v-if="can_add" class="comments__add">
						<textarea v-model="newComment" class="comments__add-area"></textarea>
						<button class="btn btn--add-comment" @click="addComment">{{msg.addComment}}</button>
					</div>
				</div>
			</div>`
});

Vue.component('comment', {
	props: ['data', 'can_switch', 'url', 'msg'],
	data: function () {
		return {
			commentClass: "comments__item",
			commentClassDisable: "comments__item--disable"
		}
	},
	methods: {
		switchCommentActive: function () {
			this.data.active = !this.data.active;
			var resource = this.$resource(this.url + '{/id}');
			var self = this;
			resource.update({id: this.data.id}, {'active': this.data.active}).then(function (response) {
				if (!response.data.status) {
					self.data.active = !self.data.active;
				}
			});
		}
	},
	template: '<div :class="[commentClass, { [commentClassDisable]: !data.active }]"><div class="comments__item-title"><span class="comments__username">{{data.username}}</span><span class="comments__date">{{data.datetime}}</span></div><div class="comments__item-text">{{data.text}}</div></div>'
});