import {usePage} from "@inertiajs/inertia-vue3";

const page = usePage()
export default {
    isSuperAdminisitrador: () => {
        return !!page.props.value.user.roles.filter(role => role.name === 'super-administrador').length;
    }
}
