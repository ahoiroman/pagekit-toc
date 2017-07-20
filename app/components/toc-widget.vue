<template>
	<div class="uk-grid pk-grid-large pk-width-sidebar-large" data-uk-grid-margin>
		<div class="pk-width-content uk-form-horizontal">
			<div class="uk-form-row">
				<label for="form-title" class="uk-form-label">{{ 'Title' | trans }}</label>
				<div class="uk-form-controls">
					<input id="form-title" class="uk-form-width-large" type="text" name="title" v-model="widget.title"
					       v-validate:required>
					<p class="uk-form-help-block uk-text-danger"
					   v-show="form.title.invalid">{{ 'Title cannot be blank.' | trans }}</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Custom CSS' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<v-editor type="code" :value.sync="widget.data.css"></v-editor>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Custom JavaScript' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<v-editor type="code" :value.sync="widget.data.js"></v-editor>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'TOC Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.toc_selector_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Content Selector' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.content_selector">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Ignore Selector' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.ignore_selector">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Smooth Scroll' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<input type="checkbox" v-model="widget.data.smoothscroll">
				</div>
			</div>
			<div v-if="widget.data.smoothscroll" class="uk-form-row">
				<label class="uk-form-label">{{ 'Smooth Scroll Duration' | trans }}</label>
				<div class="uk-form-controls">
					<input class="uk-form-width-small uk-text-right" type="number"
					       v-model="widget.data.smoothscroll_duration" min="0" number>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Link Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.link_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Active Link Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.active_link_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'List Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.list_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'List Item Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.list_item_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Collapsible Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.collapsible_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Collapsed Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.collapsed_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Collapse Depth' | trans }}</label>
				<div class="uk-form-controls">
					<select class="uk-form-large" v-model="widget.data.collapse_depth">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					</select>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Throttle Timeout' | trans }}</label>
				<div class="uk-form-controls">
					<input class="uk-form-width-small uk-text-right" type="number"
					       v-model="widget.data.throttle_timeout" min="0" number>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Heading Offset' | trans }}</label>
				<div class="uk-form-controls">
					<input class="uk-form-width-small uk-text-right" type="number"
					       v-model="widget.data.headings_offset" min="0" number>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Position Fixed Selector' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.position_fixed_selector">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Position Fixed Class' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.position_fixed_class">
					</p>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">{{ 'Fixed Sidebar Offset' | trans }}</label>
				<div class="uk-form-controls uk-form-controls-text">
					<p class="uk-form-controls-condensed">
						<input type="text" class="uk-form-width-large" v-model="widget.data.fixed_sidebar_offset">
					</p>
				</div>
			</div>
            <div class="uk-form-row">
                <form class="uk-form uk-form-stacked" v-validator="formHeadingSelector" @submit.prevent="add | valid">
                    <h2>{{ 'Heading Selectors' | trans }}</h2>
                    <div class="uk-form-row">
                        <div class="uk-grid" data-uk-margin>
                            <div class="uk-width-large-1-2">
                                <input class="uk-input-large"
                                       type="text"
                                       placeholder="{{ 'Heading Selector' | trans }}"
                                       name="heading_selector"
                                       v-model="newHeadingSelector"
                                       v-validate:required>
                                <p class="uk-form-help-block uk-text-danger"
                                   v-show="formHeadingSelector.heading_selector.invalid">
                                    {{ 'Invalid value.' | trans }}</p>
                            </div>
                            <div class="uk-width-large-1-2">
                                <div class="uk-form-controls">
                                    <span class="uk-align-right">
                                        <button class="uk-button" @click.prevent="add | valid">
                                            {{ 'Add' | trans }}
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr/>
                <div class="uk-alert"
                     v-if="!widget.data.heading_selector.length">{{ 'You can add your first heading selector using the input field above. Go ahead!' | trans }}
                </div>
                <ul class="uk-list uk-list-line" v-if="widget.data.heading_selector.length">
                    <li v-for="headingSelector in widget.data.heading_selector">
                        <input class="uk-input-large"
                               type="text"
                               placeholder="{{ 'Heading Selector' | trans }}"
                               v-model="headingSelector"/>
                        <span class="uk-align-right">
                            <button class="uk-button uk-button-danger" @click="remove(headingSelector)">
                                <i class="uk-icon-remove"></i>
                            </button>
                        </span>
                    </li>
                </ul>
            </div>
		</div>
        <div class="pk-width-sidebar">
            <partial name="settings"></partial>
        </div>
    </div>
</template>

<script>
	module.exports = {
		section: {
			label: 'Settings'
		},
		replace: false,
		props: ['widget', 'config', 'form'],
		data() {
			return {};
		},
		created() {
			this.$options.partials = this.$parent.$options.partials;
			this.$set ('widget.data', _.merge ({
				toc_selector: '.toc',
				css: '',
				js: '',
				toc_selector_class: '',
				content_selector: '.uk-article',
				ignore_selector: '.toc-ignore',
				smoothscroll: true,
				smoothscroll_duration: 420,
				link_class: 'toc-link',
				active_link_class: 'is-active-link',
				list_class: 'toc-list',
				list_item_class: 'toc-list-item',
				collapsible_class: 'is-collapsible',
				collapsed_class: 'is-collapsed',
				collapse_depth: 0,
				throttle_timeout: 50,
				headings_offset: 0,
				position_fixed_selector: null,
				position_fixed_class: 'is-position-fixed',
				fixed_sidebar_offset: 'auto',
				heading_selector: ['h1', 'h2', 'h3']
			}, this.widget.data));
		},
        methods: {
			add: function add (e) {
				e.preventDefault ();
				if (!this.newHeadingSelector) return;

				this.widget.data.heading_selector.push (this.newHeadingSelector);
				this.newHeadingSelector = '';
			},
			remove: function (headingSelector) {
				this.widget.data.heading_selector.$remove (headingSelector);
			}
		}
	};
	window.Widgets.components['spqr-toc:settings'] = module.exports;
</script>