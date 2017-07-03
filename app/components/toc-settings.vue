<template>
    <div class="uk-form uk-form-horizontal">
        <h1>{{ 'TOC Settings' | trans }}</h1>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Pages' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <input-tree :active.sync="package.config.nodes"></input-tree>
            </div>
        </div>
        <div class="uk-form-row ">
            <div class="uk-form-controls">
                <button @click="toggle(showdetails)" class="uk-button">{{ showdetails ? "Hide Details" : "Show Details" | trans }}</button>
            </div>
        </div>
        <div v-show="showdetails">
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Custom CSS' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <v-editor type="code" :value.sync="package.config.css"></v-editor>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'TOC Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.toc_selector_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Content Selector' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.content_selector">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Ignore Selector' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.ignore_selector">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Smooth Scroll' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="checkbox" v-model="package.config.smoothscroll">
                </div>
            </div>
            <div v-if="package.config.smoothscroll" class="uk-form-row">
                <label class="uk-form-label">{{ 'Smooth Scroll Duration' | trans }}</label>
                <div class="uk-form-controls">
                    <input class="uk-form-width-small uk-text-right" type="number"
                           v-model="package.config.smoothscroll_duration" min="0" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Link Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.link_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Active Link Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.active_link_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'List Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.list_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'List Item Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.list_item_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Collapsible Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.collapsible_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Collapsed Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.collapsed_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Collapse Depth' | trans }}</label>
                <div class="uk-form-controls">
                    <select class="uk-form-large" v-model="package.config.collapse_depth">
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
                           v-model="package.config.throttle_timeout" min="0" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Heading Offset' | trans }}</label>
                <div class="uk-form-controls">
                    <input class="uk-form-width-small uk-text-right" type="number"
                           v-model="package.config.headings_offset" min="0" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Position Fixed Selector' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.position_fixed_selector">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Position Fixed Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.position_fixed_class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Fixed Sidebar Offset' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.fixed_sidebar_offset">
                    </p>
                </div>
            </div>
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
                            <p class="uk-form-help-block uk-text-danger" v-show="formHeadingSelector.heading_selector.invalid">
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
            <hr />
            <div class="uk-alert" v-if="!package.config.heading_selector.length">{{ 'You can add your first heading selector using the input field above. Go ahead!' | trans }}</div>
            <ul class="uk-list uk-list-line" v-if="package.config.heading_selector.length">
                <li v-for="headingSelector in package.config.heading_selector">
                    <input class="uk-input-large"
                           type="text"
                           placeholder="{{ 'Heading Selector' | trans }}"
                           v-model="headingSelector">
                    <span class="uk-align-right">
                        <button @click="remove(headingSelector)" class="uk-button uk-button-danger">
                            <i class="uk-icon-remove"></i>
                        </button>
                    </span>
                </li>
            </ul>
        </div>
        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

    settings: true,

    props: ['package'],

    data: function () {
        return {
            'showdetails': false
        };
    },

    methods: {
        save: function save() {
			this.$http.post ('admin/system/settings/config', {
				name: 'spqr/toc',
				config: this.package.config
			}).then (function () {
				this.$notify ('Settings saved.', '');
			}).catch (function (response) {
				this.$notify (response.message, 'danger');
			}).finally (function () {
				this.$parent.close ();
			});
        },
        add: function add(e) {
            e.preventDefault();
            if (!this.newHeadingSelector) return;

            this.package.config.heading_selector.push(this.newHeadingSelector);
            this.newHeadingSelector = '';
        },
        remove: function (headingSelector) {
            this.package.config.heading_selector.$remove(headingSelector);
        },
        toggle: function(showdetails) {
            this.showdetails = !showdetails;
        },

    }
};

window.Extensions.components['toc-settings'] = module.exports;
</script>