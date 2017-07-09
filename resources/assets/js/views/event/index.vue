<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title" :params="params">
        <template scope="props">
            <tr @click="$router.push('/event/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.title}}</td>
                <td>{{props.item.start}}</td>
                <td>{{props.item.end}}</td>
                <td>{{props.item.type}}</td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'EventIndex',
        data() {
            return {
                title: 'Diary',
                source: '/api/event',
                create: '/event/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'TITLE', key: 'title', sort: true},
                    {title: 'START', key: 'start', sort: true},
                    {title: 'END', key: 'end', sort: true},
                    {title: 'TYPE', key: 'type', sort: true},
                ],
                filter: [
                    'id', 'cid', 'mpno', 'srno', 'case_no', 'cdate', 'item', 'to_whom', 'status', 'what', 'posted'
                ],
                params: {
                    column: 'id',
                    direction: 'desc',
                    per_page: 10,
                    page: 1,
                    search_column: 'id',
                    search_operator: 'equal_to',
                    search_query_1: '',
                    search_query_2: ''
                },
            }
        },
        components: {
            DataViewer
        }
    }
</script>