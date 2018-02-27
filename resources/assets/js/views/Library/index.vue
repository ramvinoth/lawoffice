<template>
    <div>
        <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title" :params="params">
            <template scope="props">
                <tr @click="loadBook(props.item.id)">
                    <td>{{props.item.id}}</td>
                    <td>{{props.item.ldate}}</td>
                    <td>{{props.item.book}}</td>
                    <td>{{props.item.author}}</td>
                </tr>
            </template>
        </data-viewer>
        <spopup>
            <div class="spop-header" slot="header">
                <span class="pop-title">{{pop_title}}</span>
                <span class="btn btn-primary btn-sm pet_edit_btn" @click="editBookInline(pop_data)"><i class="fa fa-pencil"></i></span>
            </div>
            <component :is='currentView' :data='pop_data' :options='pop_option' :mode='pop_mode' :parent='parent_data' :length='0'></component>
        </spopup>
    </div>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'
    import mixin from '../../mixins/mixin'
    import hub from '../../events/Hub'
    import spopup from '../../components/SmallPopUp.vue'
    import viewBook from '../Library/show.vue'
    import bookForm from '../Library/form.vue'
    export default {
        name: 'LibraryIndex',
        mixins: [ mixin ],
        data() {
            return {
                title: 'library',
                source: '/api/library',
                create: '/library/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'DATE', key: 'ldate', sort: true},
                    {title: 'BOOK', key: 'book', sort: true},
                    {title: 'AUTHOR', key: 'author', sort: true},
                ],
                filter: [
                    'id', 'ldate', 'book', 'author'
                ],
                params: {
                    column: 'id',
                    direction: 'desc',
                    per_page: 25,
                    page: 1,
                    search_column: 'id',
                    search_operator: 'equal_to',
                    search_query_1: '',
                    search_query_2: ''
                },
                currentView: 'viewBook',
                pop_data: [],
                pop_option: [],
                pop_mode: '',
                pop_title: '',
                parent_data: [],
                
            }
        },
        components: {
            DataViewer,
            spopup,
            viewBook,
            bookForm,
        }
    }
</script>