<template>
    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                <th scope="col" width="30%">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col" width="1"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td class="text-nowrap">
                    <form>
                        <div
                            v-for="(value, key) in user.parameters"
                            :key="key"
                            class="form-check"
                        >
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :name="key"
                                :id="`${user.id}.${key}`"
                                v-model="formData[user.id][key]"
                                @change="onParameterChanged(user.id, key)"
                            />
                            <label
                                class="form-check-label"
                                :for="`${user.id}.${key}`"
                                >{{ __(`user_parameters.${key}`) }}</label
                            >
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: {
        users: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            formData: this.users.reduce(function(map, user) {
                map[user.id] = user.parameters;

                return map;
            }, {})
        };
    },
    methods: {
        onParameterChanged: _.debounce(function(userId, parameter) {
            axios.put(`/user/${userId}/parameters`, this.formData[userId]);
        }, 500)
    }
};
</script>
