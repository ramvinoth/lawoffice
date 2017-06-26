<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title" :params="params">
        <template scope="props">
            <tr @click="$router.push('/diary/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.cdate}}</td>
                <td>{{props.item.posted}}</td>
                <td>{{props.item.case_no}}</td>
                <td>{{props.item.status}}</td>
            </tr>
        </template>
    </data-viewer>
</template>
<script>
    import DataViewer from '../../components/DataViewer.vue'

    export default {
        name: 'CaseListIndex',
        data() {
            return {
                title: 'Diary',
                source: '/api/diary',
                create: '/diary/create',
                thead: [
                    {title: 'ID', key: 'id', sort: true},
                    {title: 'DATE', key: 'cdate', sort: true},
                    {title: 'POSTED', key: 'posted', sort: true},
                    {title: 'CASE NO', key: 'case_no', sort: true},
                    {title: 'STATUS', key: 'status', sort: true},
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