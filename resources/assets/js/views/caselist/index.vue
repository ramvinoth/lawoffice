<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr @click="$router.push('/caselist/' + props.item.id)">
                <td>{{props.item.id}}</td>
                <td>{{props.item.sno}}</td>
                <td>{{props.item.case_type}}</td>
                <td>{{props.item.vno}}</td>
                <td>{{props.item.petitioner}}</td>
                <td>{{props.item.respondant}}</td>
                <td>{{props.item.refer_by}}</td>
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
                title: 'CaseList',
                source: '/api/caselist',
                create: '/caselist/create',
                thead: [
                    {title: 'SNO', key: 'id', sort: true},
                    {title: 'SR.NO', key: 'srno', sort: true},
                    {title: 'CASE TYPE', key: 'case_type', sort: true},
                    {title: 'CASE NO', key: 'case_no', sort: true},
                    {title: 'PETITIONER', key: 'petitioner', sort: true},
                    {title: 'RESPONDANT', key: 'respondant', sort: true},
                    {title: 'REFERED BY', key: 'refered_by', sort: true},
                ],
                filter: [
                    'id', 'srno', 'case_type', 'case_no', 'petitioner', 'respondant'
                ]
            }
        },
        components: {
            DataViewer
        }
    }
</script>