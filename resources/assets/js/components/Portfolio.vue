<template>
    <section class="section" id="portfolio">
        <div class="container">
            <h1 class="title">Sites Portfolio</h1>
            <h2 class="subtitle">
                A small selection of web application
                <span class="is-pulled-right">
                    <span class="is-clickable" @click="changeGridSize('is-one-third')">
                        <svgicon icon="unigrid/line/layout-grid-view-3x3" height="21" width="24" :color="gridSizeSelectionColor('is-one-third')" class=""></svgicon>
                    </span>
                    <span class="is-clickable" @click="changeGridSize('is-half')">
                        <svgicon icon="unigrid/line/layout-grid-view-2x2" height="21" width="24" :color="gridSizeSelectionColor('is-half')" class=""></svgicon>
                    </span>
                    <span class="is-clickable" @click="changeGridSize('is-12')">
                        <svgicon icon="unigrid/line/layout-grid-view-1x1" height="21" width="24" :color="gridSizeSelectionColor('is-12')" class=""></svgicon>
                    </span>
                </span>
            </h2>

            <div class="columns is-multiline content">
                <div v-for="site in sites" class="column" :class="gridSize">
                    <figure>
                        <a :href="'/sites/' + site.slug" class="is-flex flex-column mb20">
                            <img src="images/browser-toolbar.png" alt="browser-toolbar">
                            <img :src="site.media.featured">
                        </a>

                        <div class="title is-6">
                            {{ site.name }}
                        </div>

                        <div class="subtitle is-6">
                            <a :href="site.url"><small>{{ site.url }}</small></a>
                        </div>

                        <p class="content has-text-justified">
                            {{ site.description | truncate(140) }}
                        </p>

                        <div v-if="site.code_samples.length > 0" class="tags has-addons">
                            <span class="tag">Code samples</span>
                            <span class="tag is-primary">{{ site.code_samples.length }}</span>
                        </div>

                        <div class="tags">
                            <span v-for="tag in site.tags" class="tag">{{ tag.name }}</span>
                        </div>
                    </figure>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    import SaveState from 'vue-save-state';

    export default {
        data() {
            return {
                gridSize: 'is-one-third',
            }
        },

        methods: {
            changeGridSize(size) {
                this.gridSize = size
            },

            getSaveStateConfig() {
                return {
                    'cacheKey': 'Portfolio',
                };
            },

            gridSizeSelectionColor(size) {
                return this.gridSize == size ? '#0396ff' : 'black'
            },
        },

        mixins: [
            SaveState
        ],

        props: {
            sites: { default: {} }
        }
    }
</script>
