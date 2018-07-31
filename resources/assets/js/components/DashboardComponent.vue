<template>
    <b-container>
        <full-calendar :event-sources="eventSources" :events="events" :defaultView="defaultView" @event-selected="eventSelected"></full-calendar>
    </b-container>
</template>

<script>
    import { FullCalendar } from 'vue-full-calendar'

    export default {
        data() {
            return {
            events: [
                {
                    title  : 'event1',
                    start  : '2018-07-01T08:30:00',
                },
                {
                    title  : 'event2',
                    start  : '2018-07-05',
                    end    : '2018-07-07',
                },
                {
                    title  : 'event3',
                    start  : '2018-07-09T12:30:00',
                    allDay : false,
                },
            ],
            eventSources: [
                {
                    events(start, end, timezone, callback) {
                        console.log("event1" );
                        /*self.$http.get('api/task/monthly/2018-07-16', {timezone: timezone}).then(response => {
                            callback(response.data.data)
                        })*/
                        axios.defaults.headers.common['Authorization'] = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRmMTY4YTllZTcwNGZhZGFiMzIyYjhjYWY2M2E0OTAxYzBiZjA4ZWUzMGYzMGU1YTc3MTVhZmUxODc3MTljODYxNWU2Zjk3MWMwYTY1MDg1In0.eyJhdWQiOiIxIiwianRpIjoiNGYxNjhhOWVlNzA0ZmFkYWIzMjJiOGNhZjYzYTQ5MDFjMGJmMDhlZTMwZjMwZTVhNzcxNWFmZTE4NzcxOWM4NjE1ZTZmOTcxYzBhNjUwODUiLCJpYXQiOjE1MTAwMzc1NDUsIm5iZiI6MTUxMDAzNzU0NSwiZXhwIjoxNTQxNTczNTQ1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cBsRQxW8BkcZgppEauTRuZyREwIAMVMrTm7PKTeWECLQoBsNCFoeEG7Rc_yiPbuzdwNkOcw--tRWF7548esbMDHaw2DnQnRb_2HUDUrRIaikqYfVbCxtuCmmVXSDHD257l_khFcmm7apnaN76ahzK4bV-GkmzhetyOreX8Wyqjm4rYB3y_oKlQixoqoc7PDERxf2sSxotxhO3oaM6mh4ANzmdX-JPKBn7_hRHxayJVpPiVedS4GWdc-2EbCDr-7rjGxgwDvbHGbqL4vOmSN_bboX1xpXnnLJv6ZkQKSBtGwVtlSLF70lb69e1j3T7QxqHl1IbHeLGym0UhJnPb6DidJpUOYt2z79EgUAJ6My18OF67jwzByE-QdyjUyXZqRI3Sk2LV0mXlgGc2AV2qcGk7kFZ4sIvXp9UJIUj0O8u7JVcs9AzTYLG4iyhxBXIJEZyttfl_7aPfL0DcgEGCZ6W1WMw5UU5-ljEXnFRwAfGRq4d___D3S04U6MWcSs9IkCAsLIuW8h-hw6NbP1SSmAmskBr2PDDwqWxaDabM5UDXpEn8tUc8B8VY2xzAJCHHKfmR_iBlS-rsY0KPURl9aCZvsTmT5YG9ZNf0tvTa_nDzJQfqblXqwW7onggD9KGl1JgoKWu78-582iTQDdRf6_ymbdpFFy6iQkQP3Dt0YGni4'
                        axios.defaults.headers.common['Accept'] = 'application/json';
                        axios.get('api/task/monthly/2018-07-16').then(response => {this.results = response.data.results})
                        /*axios.get(
                            'api/task/monthly/2018-07-16'
                            ,{ headers: {
                                'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRmMTY4YTllZTcwNGZhZGFiMzIyYjhjYWY2M2E0OTAxYzBiZjA4ZWUzMGYzMGU1YTc3MTVhZmUxODc3MTljODYxNWU2Zjk3MWMwYTY1MDg1In0.eyJhdWQiOiIxIiwianRpIjoiNGYxNjhhOWVlNzA0ZmFkYWIzMjJiOGNhZjYzYTQ5MDFjMGJmMDhlZTMwZjMwZTVhNzcxNWFmZTE4NzcxOWM4NjE1ZTZmOTcxYzBhNjUwODUiLCJpYXQiOjE1MTAwMzc1NDUsIm5iZiI6MTUxMDAzNzU0NSwiZXhwIjoxNTQxNTczNTQ1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cBsRQxW8BkcZgppEauTRuZyREwIAMVMrTm7PKTeWECLQoBsNCFoeEG7Rc_yiPbuzdwNkOcw--tRWF7548esbMDHaw2DnQnRb_2HUDUrRIaikqYfVbCxtuCmmVXSDHD257l_khFcmm7apnaN76ahzK4bV-GkmzhetyOreX8Wyqjm4rYB3y_oKlQixoqoc7PDERxf2sSxotxhO3oaM6mh4ANzmdX-JPKBn7_hRHxayJVpPiVedS4GWdc-2EbCDr-7rjGxgwDvbHGbqL4vOmSN_bboX1xpXnnLJv6ZkQKSBtGwVtlSLF70lb69e1j3T7QxqHl1IbHeLGym0UhJnPb6DidJpUOYt2z79EgUAJ6My18OF67jwzByE-QdyjUyXZqRI3Sk2LV0mXlgGc2AV2qcGk7kFZ4sIvXp9UJIUj0O8u7JVcs9AzTYLG4iyhxBXIJEZyttfl_7aPfL0DcgEGCZ6W1WMw5UU5-ljEXnFRwAfGRq4d___D3S04U6MWcSs9IkCAsLIuW8h-hw6NbP1SSmAmskBr2PDDwqWxaDabM5UDXpEn8tUc8B8VY2xzAJCHHKfmR_iBlS-rsY0KPURl9aCZvsTmT5YG9ZNf0tvTa_nDzJQfqblXqwW7onggD9KGl1JgoKWu78-582iTQDdRf6_ymbdpFFy6iQkQP3Dt0YGni4',
                                'Accept' : 'application/json'
                                }
                            }).then(response => {this.results = response.data.results})*/
                    },
                    color: 'yellow',
                    textColor: 'black',
                },
                {
                    events(start, end, timezone, callback) {
                        console.log("event2" );
                        /*self.$http.get('api/task/monthly/2018-07-16', {timezone: self.timezone}).then(response => {
                            callback(response.data.data)
                        })*/
                        axios.get(
                            'api/task/monthly/2018-07-16'
                            ,{ headers: {
                                'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRmMTY4YTllZTcwNGZhZGFiMzIyYjhjYWY2M2E0OTAxYzBiZjA4ZWUzMGYzMGU1YTc3MTVhZmUxODc3MTljODYxNWU2Zjk3MWMwYTY1MDg1In0.eyJhdWQiOiIxIiwianRpIjoiNGYxNjhhOWVlNzA0ZmFkYWIzMjJiOGNhZjYzYTQ5MDFjMGJmMDhlZTMwZjMwZTVhNzcxNWFmZTE4NzcxOWM4NjE1ZTZmOTcxYzBhNjUwODUiLCJpYXQiOjE1MTAwMzc1NDUsIm5iZiI6MTUxMDAzNzU0NSwiZXhwIjoxNTQxNTczNTQ1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cBsRQxW8BkcZgppEauTRuZyREwIAMVMrTm7PKTeWECLQoBsNCFoeEG7Rc_yiPbuzdwNkOcw--tRWF7548esbMDHaw2DnQnRb_2HUDUrRIaikqYfVbCxtuCmmVXSDHD257l_khFcmm7apnaN76ahzK4bV-GkmzhetyOreX8Wyqjm4rYB3y_oKlQixoqoc7PDERxf2sSxotxhO3oaM6mh4ANzmdX-JPKBn7_hRHxayJVpPiVedS4GWdc-2EbCDr-7rjGxgwDvbHGbqL4vOmSN_bboX1xpXnnLJv6ZkQKSBtGwVtlSLF70lb69e1j3T7QxqHl1IbHeLGym0UhJnPb6DidJpUOYt2z79EgUAJ6My18OF67jwzByE-QdyjUyXZqRI3Sk2LV0mXlgGc2AV2qcGk7kFZ4sIvXp9UJIUj0O8u7JVcs9AzTYLG4iyhxBXIJEZyttfl_7aPfL0DcgEGCZ6W1WMw5UU5-ljEXnFRwAfGRq4d___D3S04U6MWcSs9IkCAsLIuW8h-hw6NbP1SSmAmskBr2PDDwqWxaDabM5UDXpEn8tUc8B8VY2xzAJCHHKfmR_iBlS-rsY0KPURl9aCZvsTmT5YG9ZNf0tvTa_nDzJQfqblXqwW7onggD9KGl1JgoKWu78-582iTQDdRf6_ymbdpFFy6iQkQP3Dt0YGni4',
                                'Accept' : 'application/json'
                                }
                            }).then(response => {this.results = response.data.results})
                    },
                    color: 'red',
                },
            ],
            defaultView : 'month'
            }
        },
        components: {
            FullCalendar,
        },
        methods:{
            eventSelected() {
                console.log("click" );
            },
            refreshEvents() {
                this.$refs.calendar.$emit('refetch-events')
            },

        }
    }
</script>

<style>
    @import '~fullcalendar/dist/fullcalendar.css';
</style> 
