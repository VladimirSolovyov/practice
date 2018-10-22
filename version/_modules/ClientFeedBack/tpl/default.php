<div id="feedbackModule" class="feedback">
	<div class="feedback__col">
		<div class="feedback__header">
			<div class="feedback__add-btn" @click="addState = !addState">
				<span v-if="!addState"><?= tr("добавить отзыв", "feedback") ?></span>
				<span v-else><?= tr("скрыть форму добавления", "feedback") ?></span>
			</div>
			<div class="feedback__limits">
				<span class="feedback__limit-title"><?= tr("Показывать по") ?></span>
				<span v-for="limitView in limits" @click="changeLimit(limitView)" :class="[limitsClass, { [limitsClassActive]: limit == limitView }]">{{limitView}}</span>
			</div>
		</div>
		<div class="feedback__list">
			<div v-for="feedBack in feedBacks" :class="[feedBackClass, { [feedBackClassDisable]: !feedBack.active }]">
				<div class="feedback__item-title">
					{{feedBack.fb_name}}
				</div>

				<div class="feedback__item-info">
					<div class="feedback__item-rating">
						<span class="feedback__param-name"><?= tr('Оценка', 'feedback') ?></span>
						<span class="feedback__param-stars">
							<star-rating :rating="feedBack.fb_rating" inline="false" border-color="#ffcc50" inactive-color="#ffffff" :border-width="3" :star-size="13" :read-only="true" :show-rating="false"></star-rating>
						</span>
					</div>

					<div class="feedback__item-date"><?= tr('От', 'feedback') ?> <span class="feedback__item-username">{{ feedBack.username }}</span>
						{{feedBack.fb_datetime}}
					</div>
				</div>

				<div class="feedback__item-text">
					{{ feedBack.fb_text }}
				</div>

				<div>
					<div class="feedback__param-name"><?= tr('Достоинства', 'feedback') ?></div>
					<div class="feedback__param-value">{{ feedBack.fb_plus }}</div>
				</div>

				<div>
					<div class="feedback__param-name"><?= tr('Недостатки', 'feedback') ?></div>
					<div class="feedback__param-value">{{ feedBack.fb_minus }}</div>
				</div>

				<comments :id=feedBack.fb_id :count=feedBack.comments_count :msg="msg" <? if ($canAddComment){ ?>can_add=1<? } ?> :url=commentsUrl :can_switch="can_switch" class="feedback__item-comments"></comments>
			</div>
			<paginator :limit="limit" :page="page" :count="allFeedBacksCount" :url="listUrl" @update="updateFeedBacks"></paginator>
		</div>
	</div>
	<div class="feedback__col">

		<div class="feedback__msg-moderating" v-show="showMsgModerating"><?= tr('Ваш отзыв принят, после модерации он будет опубликован на сайте', 'feedback') ?></div>

		<form v-if="addState" class="feedback-form feedback__add-form">
			<div class="feedback-form__caption"><?= tr('Оставить отзыв', 'feedback') ?></div>
			<div class="feedback-form__item">
				<div class="feedback-form__title"><?= tr('Оценка', 'feedback') ?></div>
				<star-rating @rating-selected="setRating" border-color="#ffcc50" inactive-color="#ffffff" :border-width="3" :show-rating="false" :star-size="13"></star-rating>
			</div>
			<div class="feedback-form__item">
				<div class="feedback-form__title"><?= tr('Тема', 'feedback') ?></div>
				<div class="feedback-form__input">
					<input name="fb_name" type="text" v-model="newFeedBack.fb_name" required>
				</div>
			</div>
			<div class="feedback-form__item">
				<div class="feedback-form__title"><?= tr('Достоинства', 'feedback') ?></div>
				<div class="feedback-form__input"><input name="fb_plus" type="text" v-model="newFeedBack.fb_plus"></div>
			</div>
			<div class="feedback-form__item">
				<div class="feedback-form__title"><?= tr('Недостатки', 'feedback') ?></div>
				<div class="feedback-form__input"><input name="fb_minus" type="text" v-model="newFeedBack.fb_minus"></div>
			</div>
			<div class="feedback-form__item">
				<div class="feedback-form__title-review"><?= tr('Отзыв', 'feedback') ?></div>
				<div class="feedback-form__input"><textarea name="fb_text" v-model="newFeedBack.fb_text"></textarea></div>
			</div>
			<div class="feedback-form__item">
				<button class="btn btn--add-review feedback-form__btn-add-review" @click.prevent="saveFeedBack"><?= tr('Оставить отзыв', 'feedback') ?></button>
			</div>
		</form>
	</div>
</div>