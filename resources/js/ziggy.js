const Ziggy = {
    url: "http://localhost",
    port: null,
    defaults: {},
    routes: {
        login: { uri: "login", methods: ["GET", "HEAD"] },
        logout: { uri: "logout", methods: ["POST"] },
        "password.request": {
            uri: "forgot-password",
            methods: ["GET", "HEAD"],
        },
        "password.reset": {
            uri: "reset-password/{token}",
            methods: ["GET", "HEAD"],
            parameters: ["token"],
        },
        "password.email": { uri: "forgot-password", methods: ["POST"] },
        "password.update": { uri: "reset-password", methods: ["POST"] },
        register: { uri: "register", methods: ["GET", "HEAD"] },
        "user-profile-information.update": {
            uri: "user/profile-information",
            methods: ["PUT"],
        },
        "user-password.update": { uri: "user/password", methods: ["PUT"] },
        "password.confirmation": {
            uri: "user/confirmed-password-status",
            methods: ["GET", "HEAD"],
        },
        "password.confirm": { uri: "user/confirm-password", methods: ["POST"] },
        "two-factor.login": {
            uri: "two-factor-challenge",
            methods: ["GET", "HEAD"],
        },
        "two-factor.enable": {
            uri: "user/two-factor-authentication",
            methods: ["POST"],
        },
        "two-factor.confirm": {
            uri: "user/confirmed-two-factor-authentication",
            methods: ["POST"],
        },
        "two-factor.disable": {
            uri: "user/two-factor-authentication",
            methods: ["DELETE"],
        },
        "two-factor.qr-code": {
            uri: "user/two-factor-qr-code",
            methods: ["GET", "HEAD"],
        },
        "two-factor.secret-key": {
            uri: "user/two-factor-secret-key",
            methods: ["GET", "HEAD"],
        },
        "two-factor.recovery-codes": {
            uri: "user/two-factor-recovery-codes",
            methods: ["GET", "HEAD"],
        },
        "profile.show": { uri: "user/profile", methods: ["GET", "HEAD"] },
        "sanctum.csrf-cookie": {
            uri: "sanctum/csrf-cookie",
            methods: ["GET", "HEAD"],
        },
        "livewire.message": {
            uri: "livewire/message/{name}",
            methods: ["POST"],
            parameters: ["name"],
        },
        "livewire.message-localized": {
            uri: "{locale}/livewire/message/{name}",
            methods: ["POST"],
            parameters: ["locale", "name"],
        },
        "livewire.upload-file": {
            uri: "livewire/upload-file",
            methods: ["POST"],
        },
        "livewire.preview-file": {
            uri: "livewire/preview-file/{filename}",
            methods: ["GET", "HEAD"],
            parameters: ["filename"],
        },
        "ignition.healthCheck": {
            uri: "_ignition/health-check",
            methods: ["GET", "HEAD"],
        },
        "ignition.executeSolution": {
            uri: "_ignition/execute-solution",
            methods: ["POST"],
        },
        "ignition.updateConfig": {
            uri: "_ignition/update-config",
            methods: ["POST"],
        },
        "dashboard.index": {
            uri: "backsite/dashboard",
            methods: ["GET", "HEAD"],
        },
        "backsite.dashboard.create": {
            uri: "backsite/dashboard/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.dashboard.store": {
            uri: "backsite/dashboard",
            methods: ["POST"],
        },
        "backsite.dashboard.show": {
            uri: "backsite/dashboard/{dashboard}",
            methods: ["GET", "HEAD"],
            parameters: ["dashboard"],
        },
        "backsite.dashboard.edit": {
            uri: "backsite/dashboard/{dashboard}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["dashboard"],
        },
        "backsite.dashboard.update": {
            uri: "backsite/dashboard/{dashboard}",
            methods: ["PUT", "PATCH"],
            parameters: ["dashboard"],
        },
        "backsite.dashboard.destroy": {
            uri: "backsite/dashboard/{dashboard}",
            methods: ["DELETE"],
            parameters: ["dashboard"],
        },
        "backsite.type_user.index": {
            uri: "backsite/type_user",
            methods: ["GET", "HEAD"],
        },
        "backsite.type_user.create": {
            uri: "backsite/type_user/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.type_user.store": {
            uri: "backsite/type_user",
            methods: ["POST"],
        },
        "backsite.type_user.show": {
            uri: "backsite/type_user/{type_user}",
            methods: ["GET", "HEAD"],
            parameters: ["type_user"],
        },
        "backsite.type_user.edit": {
            uri: "backsite/type_user/{type_user}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["type_user"],
        },
        "backsite.type_user.update": {
            uri: "backsite/type_user/{type_user}",
            methods: ["PUT", "PATCH"],
            parameters: ["type_user"],
            bindings: { type_user: "id" },
        },
        "backsite.type_user.destroy": {
            uri: "backsite/type_user/{type_user}",
            methods: ["DELETE"],
            parameters: ["type_user"],
        },
        "backsite.user.index": {
            uri: "backsite/user",
            methods: ["GET", "HEAD"],
        },
        "backsite.user.create": {
            uri: "backsite/user/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.user.store": { uri: "backsite/user", methods: ["POST"] },
        "backsite.user.show": {
            uri: "backsite/user/{user}",
            methods: ["GET", "HEAD"],
            parameters: ["user"],
        },
        "backsite.user.edit": {
            uri: "backsite/user/{user}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["user"],
        },
        "backsite.user.update": {
            uri: "backsite/user/{user}",
            methods: ["PUT", "PATCH"],
            parameters: ["user"],
            bindings: { user: "id" },
        },
        "backsite.user.destroy": {
            uri: "backsite/user/{user}",
            methods: ["DELETE"],
            parameters: ["user"],
        },
        "backsite.profile.index": {
            uri: "backsite/profile",
            methods: ["GET", "HEAD"],
        },
        "backsite.profile.create": {
            uri: "backsite/profile/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.profile.store": {
            uri: "backsite/profile",
            methods: ["POST"],
        },
        "backsite.profile.show": {
            uri: "backsite/profile/{profile}",
            methods: ["GET", "HEAD"],
            parameters: ["profile"],
        },
        "backsite.profile.edit": {
            uri: "backsite/profile/{profile}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["profile"],
        },
        "backsite.profile.update": {
            uri: "backsite/profile/{profile}",
            methods: ["PUT", "PATCH"],
            parameters: ["profile"],
        },
        "backsite.profile.destroy": {
            uri: "backsite/profile/{profile}",
            methods: ["DELETE"],
            parameters: ["profile"],
        },
        "backsite.location.index": {
            uri: "backsite/location",
            methods: ["GET", "HEAD"],
        },
        "backsite.location.create": {
            uri: "backsite/location/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.location.store": {
            uri: "backsite/location",
            methods: ["POST"],
        },
        "backsite.location.show": {
            uri: "backsite/location/{location}",
            methods: ["GET", "HEAD"],
            parameters: ["location"],
        },
        "backsite.location.edit": {
            uri: "backsite/location/{location}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["location"],
        },
        "backsite.location.update": {
            uri: "backsite/location/{location}",
            methods: ["PUT", "PATCH"],
            parameters: ["location"],
            bindings: { location: "id" },
        },
        "backsite.location.destroy": {
            uri: "backsite/location/{location}",
            methods: ["DELETE"],
            parameters: ["location"],
        },
        "backsite.location_sub.index": {
            uri: "backsite/location_sub",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_sub.create": {
            uri: "backsite/location_sub/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_sub.store": {
            uri: "backsite/location_sub",
            methods: ["POST"],
        },
        "backsite.location_sub.show": {
            uri: "backsite/location_sub/{location_sub}",
            methods: ["GET", "HEAD"],
            parameters: ["location_sub"],
        },
        "backsite.location_sub.edit": {
            uri: "backsite/location_sub/{location_sub}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["location_sub"],
        },
        "backsite.location_sub.update": {
            uri: "backsite/location_sub/{location_sub}",
            methods: ["PUT", "PATCH"],
            parameters: ["location_sub"],
            bindings: { location_sub: "id" },
        },
        "backsite.location_sub.destroy": {
            uri: "backsite/location_sub/{location_sub}",
            methods: ["DELETE"],
            parameters: ["location_sub"],
        },
        "backsite.location_room.index": {
            uri: "backsite/location_room",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_room.create": {
            uri: "backsite/location_room/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_room.store": {
            uri: "backsite/location_room",
            methods: ["POST"],
        },
        "backsite.location_room.show": {
            uri: "backsite/location_room/{location_room}",
            methods: ["GET", "HEAD"],
            parameters: ["location_room"],
        },
        "backsite.location_room.edit": {
            uri: "backsite/location_room/{location_room}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["location_room"],
        },
        "backsite.location_room.update": {
            uri: "backsite/location_room/{location_room}",
            methods: ["PUT", "PATCH"],
            parameters: ["location_room"],
            bindings: { location_room: "id" },
        },
        "backsite.location_room.destroy": {
            uri: "backsite/location_room/{location_room}",
            methods: ["DELETE"],
            parameters: ["location_room"],
        },
        "backsite.getSubLocations": {
            uri: "backsite/get-sub-locations",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_detail.index": {
            uri: "backsite/location_detail",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_detail.create": {
            uri: "backsite/location_detail/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.location_detail.store": {
            uri: "backsite/location_detail",
            methods: ["POST"],
        },
        "backsite.location_detail.show": {
            uri: "backsite/location_detail/{location_detail}",
            methods: ["GET", "HEAD"],
            parameters: ["location_detail"],
        },
        "backsite.location_detail.edit": {
            uri: "backsite/location_detail/{location_detail}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["location_detail"],
        },
        "backsite.location_detail.update": {
            uri: "backsite/location_detail/{location_detail}",
            methods: ["PUT", "PATCH"],
            parameters: ["location_detail"],
            bindings: { location_detail: "id" },
        },
        "backsite.location_detail.destroy": {
            uri: "backsite/location_detail/{location_detail}",
            methods: ["DELETE"],
            parameters: ["location_detail"],
        },
        "backsite.division.index": {
            uri: "backsite/division",
            methods: ["GET", "HEAD"],
        },
        "backsite.division.create": {
            uri: "backsite/division/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.division.store": {
            uri: "backsite/division",
            methods: ["POST"],
        },
        "backsite.division.show": {
            uri: "backsite/division/{division}",
            methods: ["GET", "HEAD"],
            parameters: ["division"],
        },
        "backsite.division.edit": {
            uri: "backsite/division/{division}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["division"],
        },
        "backsite.division.update": {
            uri: "backsite/division/{division}",
            methods: ["PUT", "PATCH"],
            parameters: ["division"],
            bindings: { division: "id" },
        },
        "backsite.division.destroy": {
            uri: "backsite/division/{division}",
            methods: ["DELETE"],
            parameters: ["division"],
        },
        "backsite.department.index": {
            uri: "backsite/department",
            methods: ["GET", "HEAD"],
        },
        "backsite.department.create": {
            uri: "backsite/department/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.department.store": {
            uri: "backsite/department",
            methods: ["POST"],
        },
        "backsite.department.show": {
            uri: "backsite/department/{department}",
            methods: ["GET", "HEAD"],
            parameters: ["department"],
        },
        "backsite.department.edit": {
            uri: "backsite/department/{department}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["department"],
        },
        "backsite.department.update": {
            uri: "backsite/department/{department}",
            methods: ["PUT", "PATCH"],
            parameters: ["department"],
            bindings: { department: "id" },
        },
        "backsite.department.destroy": {
            uri: "backsite/department/{department}",
            methods: ["DELETE"],
            parameters: ["department"],
        },
        "backsite.section.get_department": {
            uri: "backsite/section/get_department",
            methods: ["POST"],
        },
        "backsite.section.get_section": {
            uri: "backsite/section/get_section",
            methods: ["POST"],
        },
        "backsite.section.index": {
            uri: "backsite/section",
            methods: ["GET", "HEAD"],
        },
        "backsite.section.create": {
            uri: "backsite/section/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.section.store": {
            uri: "backsite/section",
            methods: ["POST"],
        },
        "backsite.section.show": {
            uri: "backsite/section/{section}",
            methods: ["GET", "HEAD"],
            parameters: ["section"],
        },
        "backsite.section.edit": {
            uri: "backsite/section/{section}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["section"],
        },
        "backsite.section.update": {
            uri: "backsite/section/{section}",
            methods: ["PUT", "PATCH"],
            parameters: ["section"],
            bindings: { section: "id" },
        },
        "backsite.section.destroy": {
            uri: "backsite/section/{section}",
            methods: ["DELETE"],
            parameters: ["section"],
        },
        "backsite.work_category.index": {
            uri: "backsite/work_category",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_category.create": {
            uri: "backsite/work_category/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_category.store": {
            uri: "backsite/work_category",
            methods: ["POST"],
        },
        "backsite.work_category.show": {
            uri: "backsite/work_category/{work_category}",
            methods: ["GET", "HEAD"],
            parameters: ["work_category"],
        },
        "backsite.work_category.edit": {
            uri: "backsite/work_category/{work_category}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["work_category"],
        },
        "backsite.work_category.update": {
            uri: "backsite/work_category/{work_category}",
            methods: ["PUT", "PATCH"],
            parameters: ["work_category"],
            bindings: { work_category: "id" },
        },
        "backsite.work_category.destroy": {
            uri: "backsite/work_category/{work_category}",
            methods: ["DELETE"],
            parameters: ["work_category"],
        },
        "backsite.work_type.index": {
            uri: "backsite/work_type",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_type.create": {
            uri: "backsite/work_type/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_type.store": {
            uri: "backsite/work_type",
            methods: ["POST"],
        },
        "backsite.work_type.show": {
            uri: "backsite/work_type/{work_type}",
            methods: ["GET", "HEAD"],
            parameters: ["work_type"],
        },
        "backsite.work_type.edit": {
            uri: "backsite/work_type/{work_type}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["work_type"],
        },
        "backsite.work_type.update": {
            uri: "backsite/work_type/{work_type}",
            methods: ["PUT", "PATCH"],
            parameters: ["work_type"],
            bindings: { work_type: "id" },
        },
        "backsite.work_type.destroy": {
            uri: "backsite/work_type/{work_type}",
            methods: ["DELETE"],
            parameters: ["work_type"],
        },
        "backsite.employee.index": {
            uri: "backsite/employee",
            methods: ["GET", "HEAD"],
        },
        "backsite.employee.create": {
            uri: "backsite/employee/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.employee.store": {
            uri: "backsite/employee",
            methods: ["POST"],
        },
        "backsite.employee.show": {
            uri: "backsite/employee/{employee}",
            methods: ["GET", "HEAD"],
            parameters: ["employee"],
        },
        "backsite.employee.edit": {
            uri: "backsite/employee/{employee}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["employee"],
        },
        "backsite.employee.update": {
            uri: "backsite/employee/{employee}",
            methods: ["PUT", "PATCH"],
            parameters: ["employee"],
            bindings: { employee: "id" },
        },
        "backsite.employee.destroy": {
            uri: "backsite/employee/{employee}",
            methods: ["DELETE"],
            parameters: ["employee"],
        },
        "backsite.work_program.index": {
            uri: "backsite/work_program",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_program.create": {
            uri: "backsite/work_program/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.work_program.store": {
            uri: "backsite/work_program",
            methods: ["POST"],
        },
        "backsite.work_program.show": {
            uri: "backsite/work_program/{work_program}",
            methods: ["GET", "HEAD"],
            parameters: ["work_program"],
        },
        "backsite.work_program.edit": {
            uri: "backsite/work_program/{work_program}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["work_program"],
        },
        "backsite.work_program.update": {
            uri: "backsite/work_program/{work_program}",
            methods: ["PUT", "PATCH"],
            parameters: ["work_program"],
            bindings: { work_program: "id" },
        },
        "backsite.work_program.destroy": {
            uri: "backsite/work_program/{work_program}",
            methods: ["DELETE"],
            parameters: ["work_program"],
        },
        "backsite.daily_activity.form_upload": {
            uri: "backsite/daily_activity/form_upload",
            methods: ["POST"],
        },
        "backsite.daily_activity.upload": {
            uri: "backsite/daily_activity/upload",
            methods: ["POST"],
        },
        "backsite.daily_activity.show_file": {
            uri: "backsite/daily_activity/show_file",
            methods: ["POST"],
        },
        "backsite.daily_activity.hapus_file": {
            uri: "backsite/daily_activity/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.daily_activity.index": {
            uri: "backsite/daily_activity",
            methods: ["GET", "HEAD"],
        },
        "backsite.daily_activity.create": {
            uri: "backsite/daily_activity/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.daily_activity.store": {
            uri: "backsite/daily_activity",
            methods: ["POST"],
        },
        "backsite.daily_activity.show": {
            uri: "backsite/daily_activity/{daily_activity}",
            methods: ["GET", "HEAD"],
            parameters: ["daily_activity"],
        },
        "backsite.daily_activity.edit": {
            uri: "backsite/daily_activity/{daily_activity}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["daily_activity"],
        },
        "backsite.daily_activity.update": {
            uri: "backsite/daily_activity/{daily_activity}",
            methods: ["PUT", "PATCH"],
            parameters: ["daily_activity"],
            bindings: { daily_activity: "id" },
        },
        "backsite.daily_activity.destroy": {
            uri: "backsite/daily_activity/{daily_activity}",
            methods: ["DELETE"],
            parameters: ["daily_activity"],
        },
        "backsite.software.form_upload": {
            uri: "backsite/software/form_upload",
            methods: ["POST"],
        },
        "backsite.software.upload": {
            uri: "backsite/software/upload",
            methods: ["POST"],
        },
        "backsite.software.show_file": {
            uri: "backsite/software/show_file",
            methods: ["POST"],
        },
        "backsite.software.hapus_file": {
            uri: "backsite/software/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.software.index": {
            uri: "backsite/software",
            methods: ["GET", "HEAD"],
        },
        "backsite.software.create": {
            uri: "backsite/software/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.software.store": {
            uri: "backsite/software",
            methods: ["POST"],
        },
        "backsite.software.show": {
            uri: "backsite/software/{software}",
            methods: ["GET", "HEAD"],
            parameters: ["software"],
        },
        "backsite.software.edit": {
            uri: "backsite/software/{software}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["software"],
        },
        "backsite.software.update": {
            uri: "backsite/software/{software}",
            methods: ["PUT", "PATCH"],
            parameters: ["software"],
            bindings: { software: "id" },
        },
        "backsite.software.destroy": {
            uri: "backsite/software/{software}",
            methods: ["DELETE"],
            parameters: ["software"],
        },
        "backsite.hardisk.index": {
            uri: "backsite/hardisk",
            methods: ["GET", "HEAD"],
        },
        "backsite.hardisk.create": {
            uri: "backsite/hardisk/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.hardisk.store": {
            uri: "backsite/hardisk",
            methods: ["POST"],
        },
        "backsite.hardisk.show": {
            uri: "backsite/hardisk/{hardisk}",
            methods: ["GET", "HEAD"],
            parameters: ["hardisk"],
        },
        "backsite.hardisk.edit": {
            uri: "backsite/hardisk/{hardisk}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["hardisk"],
        },
        "backsite.hardisk.update": {
            uri: "backsite/hardisk/{hardisk}",
            methods: ["PUT", "PATCH"],
            parameters: ["hardisk"],
            bindings: { hardisk: "id" },
        },
        "backsite.hardisk.destroy": {
            uri: "backsite/hardisk/{hardisk}",
            methods: ["DELETE"],
            parameters: ["hardisk"],
        },
        "backsite.monitor.index": {
            uri: "backsite/monitor",
            methods: ["GET", "HEAD"],
        },
        "backsite.monitor.create": {
            uri: "backsite/monitor/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.monitor.store": {
            uri: "backsite/monitor",
            methods: ["POST"],
        },
        "backsite.monitor.show": {
            uri: "backsite/monitor/{monitor}",
            methods: ["GET", "HEAD"],
            parameters: ["monitor"],
        },
        "backsite.monitor.edit": {
            uri: "backsite/monitor/{monitor}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["monitor"],
        },
        "backsite.monitor.update": {
            uri: "backsite/monitor/{monitor}",
            methods: ["PUT", "PATCH"],
            parameters: ["monitor"],
            bindings: { monitor: "id" },
        },
        "backsite.monitor.destroy": {
            uri: "backsite/monitor/{monitor}",
            methods: ["DELETE"],
            parameters: ["monitor"],
        },
        "backsite.motherboard.index": {
            uri: "backsite/motherboard",
            methods: ["GET", "HEAD"],
        },
        "backsite.motherboard.create": {
            uri: "backsite/motherboard/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.motherboard.store": {
            uri: "backsite/motherboard",
            methods: ["POST"],
        },
        "backsite.motherboard.show": {
            uri: "backsite/motherboard/{motherboard}",
            methods: ["GET", "HEAD"],
            parameters: ["motherboard"],
        },
        "backsite.motherboard.edit": {
            uri: "backsite/motherboard/{motherboard}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["motherboard"],
        },
        "backsite.motherboard.update": {
            uri: "backsite/motherboard/{motherboard}",
            methods: ["PUT", "PATCH"],
            parameters: ["motherboard"],
            bindings: { motherboard: "id" },
        },
        "backsite.motherboard.destroy": {
            uri: "backsite/motherboard/{motherboard}",
            methods: ["DELETE"],
            parameters: ["motherboard"],
        },
        "backsite.processor.index": {
            uri: "backsite/processor",
            methods: ["GET", "HEAD"],
        },
        "backsite.processor.create": {
            uri: "backsite/processor/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.processor.store": {
            uri: "backsite/processor",
            methods: ["POST"],
        },
        "backsite.processor.show": {
            uri: "backsite/processor/{processor}",
            methods: ["GET", "HEAD"],
            parameters: ["processor"],
        },
        "backsite.processor.edit": {
            uri: "backsite/processor/{processor}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["processor"],
        },
        "backsite.processor.update": {
            uri: "backsite/processor/{processor}",
            methods: ["PUT", "PATCH"],
            parameters: ["processor"],
            bindings: { processor: "id" },
        },
        "backsite.processor.destroy": {
            uri: "backsite/processor/{processor}",
            methods: ["DELETE"],
            parameters: ["processor"],
        },
        "backsite.ram.index": { uri: "backsite/ram", methods: ["GET", "HEAD"] },
        "backsite.ram.create": {
            uri: "backsite/ram/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.ram.store": { uri: "backsite/ram", methods: ["POST"] },
        "backsite.ram.show": {
            uri: "backsite/ram/{ram}",
            methods: ["GET", "HEAD"],
            parameters: ["ram"],
        },
        "backsite.ram.edit": {
            uri: "backsite/ram/{ram}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["ram"],
        },
        "backsite.ram.update": {
            uri: "backsite/ram/{ram}",
            methods: ["PUT", "PATCH"],
            parameters: ["ram"],
            bindings: { ram: "id" },
        },
        "backsite.ram.destroy": {
            uri: "backsite/ram/{ram}",
            methods: ["DELETE"],
            parameters: ["ram"],
        },
        "backsite.type_device.index": {
            uri: "backsite/type_device",
            methods: ["GET", "HEAD"],
        },
        "backsite.type_device.create": {
            uri: "backsite/type_device/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.type_device.store": {
            uri: "backsite/type_device",
            methods: ["POST"],
        },
        "backsite.type_device.show": {
            uri: "backsite/type_device/{type_device}",
            methods: ["GET", "HEAD"],
            parameters: ["type_device"],
        },
        "backsite.type_device.edit": {
            uri: "backsite/type_device/{type_device}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["type_device"],
        },
        "backsite.type_device.update": {
            uri: "backsite/type_device/{type_device}",
            methods: ["PUT", "PATCH"],
            parameters: ["type_device"],
            bindings: { type_device: "id" },
        },
        "backsite.type_device.destroy": {
            uri: "backsite/type_device/{type_device}",
            methods: ["DELETE"],
            parameters: ["type_device"],
        },
        "backsite.additional_device.index": {
            uri: "backsite/additional_device",
            methods: ["GET", "HEAD"],
        },
        "backsite.additional_device.create": {
            uri: "backsite/additional_device/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.additional_device.store": {
            uri: "backsite/additional_device",
            methods: ["POST"],
        },
        "backsite.additional_device.show": {
            uri: "backsite/additional_device/{additional_device}",
            methods: ["GET", "HEAD"],
            parameters: ["additional_device"],
        },
        "backsite.additional_device.edit": {
            uri: "backsite/additional_device/{additional_device}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["additional_device"],
        },
        "backsite.additional_device.update": {
            uri: "backsite/additional_device/{additional_device}",
            methods: ["PUT", "PATCH"],
            parameters: ["additional_device"],
            bindings: { additional_device: "id" },
        },
        "backsite.additional_device.destroy": {
            uri: "backsite/additional_device/{additional_device}",
            methods: ["DELETE"],
            parameters: ["additional_device"],
        },
        "backsite.device_hardware.index": {
            uri: "backsite/device_hardware",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_hardware.create": {
            uri: "backsite/device_hardware/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_hardware.store": {
            uri: "backsite/device_hardware",
            methods: ["POST"],
        },
        "backsite.device_hardware.show": {
            uri: "backsite/device_hardware/{device_hardware}",
            methods: ["GET", "HEAD"],
            parameters: ["device_hardware"],
        },
        "backsite.device_hardware.edit": {
            uri: "backsite/device_hardware/{device_hardware}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["device_hardware"],
        },
        "backsite.device_hardware.update": {
            uri: "backsite/device_hardware/{device_hardware}",
            methods: ["PUT", "PATCH"],
            parameters: ["device_hardware"],
        },
        "backsite.device_hardware.destroy": {
            uri: "backsite/device_hardware/{device_hardware}",
            methods: ["DELETE"],
            parameters: ["device_hardware"],
        },
        "backsite.device_pc.index": {
            uri: "backsite/device_pc",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_pc.create": {
            uri: "backsite/device_pc/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_pc.store": {
            uri: "backsite/device_pc",
            methods: ["POST"],
        },
        "backsite.device_pc.show": {
            uri: "backsite/device_pc/{device_pc}",
            methods: ["GET", "HEAD"],
            parameters: ["device_pc"],
        },
        "backsite.device_pc.edit": {
            uri: "backsite/device_pc/{device_pc}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["device_pc"],
        },
        "backsite.device_pc.update": {
            uri: "backsite/device_pc/{device_pc}",
            methods: ["PUT", "PATCH"],
            parameters: ["device_pc"],
            bindings: { device_pc: "id" },
        },
        "backsite.device_pc.destroy": {
            uri: "backsite/device_pc/{device_pc}",
            methods: ["DELETE"],
            parameters: ["device_pc"],
        },
        "backsite.device_monitor.index": {
            uri: "backsite/device_monitor",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_monitor.create": {
            uri: "backsite/device_monitor/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_monitor.store": {
            uri: "backsite/device_monitor",
            methods: ["POST"],
        },
        "backsite.device_monitor.show": {
            uri: "backsite/device_monitor/{device_monitor}",
            methods: ["GET", "HEAD"],
            parameters: ["device_monitor"],
        },
        "backsite.device_monitor.edit": {
            uri: "backsite/device_monitor/{device_monitor}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["device_monitor"],
        },
        "backsite.device_monitor.update": {
            uri: "backsite/device_monitor/{device_monitor}",
            methods: ["PUT", "PATCH"],
            parameters: ["device_monitor"],
            bindings: { device_monitor: "id" },
        },
        "backsite.device_monitor.destroy": {
            uri: "backsite/device_monitor/{device_monitor}",
            methods: ["DELETE"],
            parameters: ["device_monitor"],
        },
        "backsite.device_additional.index": {
            uri: "backsite/device_additional",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_additional.create": {
            uri: "backsite/device_additional/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_additional.store": {
            uri: "backsite/device_additional",
            methods: ["POST"],
        },
        "backsite.device_additional.show": {
            uri: "backsite/device_additional/{device_additional}",
            methods: ["GET", "HEAD"],
            parameters: ["device_additional"],
        },
        "backsite.device_additional.edit": {
            uri: "backsite/device_additional/{device_additional}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["device_additional"],
        },
        "backsite.device_additional.update": {
            uri: "backsite/device_additional/{device_additional}",
            methods: ["PUT", "PATCH"],
            parameters: ["device_additional"],
            bindings: { device_additional: "id" },
        },
        "backsite.device_additional.destroy": {
            uri: "backsite/device_additional/{device_additional}",
            methods: ["DELETE"],
            parameters: ["device_additional"],
        },
        "backsite.device_more.index": {
            uri: "backsite/device_more",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_more.create": {
            uri: "backsite/device_more/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.device_more.store": {
            uri: "backsite/device_more",
            methods: ["POST"],
        },
        "backsite.device_more.show": {
            uri: "backsite/device_more/{device_more}",
            methods: ["GET", "HEAD"],
            parameters: ["device_more"],
        },
        "backsite.device_more.edit": {
            uri: "backsite/device_more/{device_more}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["device_more"],
        },
        "backsite.device_more.update": {
            uri: "backsite/device_more/{device_more}",
            methods: ["PUT", "PATCH"],
            parameters: ["device_more"],
            bindings: { device_more: "id" },
        },
        "backsite.device_more.destroy": {
            uri: "backsite/device_more/{device_more}",
            methods: ["DELETE"],
            parameters: ["device_more"],
        },
        "backsite.information.index": {
            uri: "backsite/information",
            methods: ["GET", "HEAD"],
        },
        "backsite.information.create": {
            uri: "backsite/information/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.information.store": {
            uri: "backsite/information",
            methods: ["POST"],
        },
        "backsite.information.show": {
            uri: "backsite/information/{information}",
            methods: ["GET", "HEAD"],
            parameters: ["information"],
            bindings: { information: "id" },
        },
        "backsite.information.edit": {
            uri: "backsite/information/{information}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["information"],
        },
        "backsite.information.update": {
            uri: "backsite/information/{information}",
            methods: ["PUT", "PATCH"],
            parameters: ["information"],
            bindings: { information: "id" },
        },
        "backsite.information.destroy": {
            uri: "backsite/information/{information}",
            methods: ["DELETE"],
            parameters: ["information"],
        },
        "backsite.vendor_ti.index": {
            uri: "backsite/vendor_ti",
            methods: ["GET", "HEAD"],
        },
        "backsite.vendor_ti.create": {
            uri: "backsite/vendor_ti/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.vendor_ti.store": {
            uri: "backsite/vendor_ti",
            methods: ["POST"],
        },
        "backsite.vendor_ti.show": {
            uri: "backsite/vendor_ti/{vendor_ti}",
            methods: ["GET", "HEAD"],
            parameters: ["vendor_ti"],
        },
        "backsite.vendor_ti.edit": {
            uri: "backsite/vendor_ti/{vendor_ti}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["vendor_ti"],
        },
        "backsite.vendor_ti.update": {
            uri: "backsite/vendor_ti/{vendor_ti}",
            methods: ["PUT", "PATCH"],
            parameters: ["vendor_ti"],
        },
        "backsite.vendor_ti.destroy": {
            uri: "backsite/vendor_ti/{vendor_ti}",
            methods: ["DELETE"],
            parameters: ["vendor_ti"],
        },
        "backsite.jobdesk.index": {
            uri: "backsite/jobdesk",
            methods: ["GET", "HEAD"],
        },
        "backsite.jobdesk.create": {
            uri: "backsite/jobdesk/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.jobdesk.store": {
            uri: "backsite/jobdesk",
            methods: ["POST"],
        },
        "backsite.jobdesk.show": {
            uri: "backsite/jobdesk/{jobdesk}",
            methods: ["GET", "HEAD"],
            parameters: ["jobdesk"],
        },
        "backsite.jobdesk.edit": {
            uri: "backsite/jobdesk/{jobdesk}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["jobdesk"],
        },
        "backsite.jobdesk.update": {
            uri: "backsite/jobdesk/{jobdesk}",
            methods: ["PUT", "PATCH"],
            parameters: ["jobdesk"],
            bindings: { jobdesk: "id" },
        },
        "backsite.jobdesk.destroy": {
            uri: "backsite/jobdesk/{jobdesk}",
            methods: ["DELETE"],
            parameters: ["jobdesk"],
        },
        "backsite.demand.index": {
            uri: "backsite/demand",
            methods: ["GET", "HEAD"],
        },
        "backsite.demand.create": {
            uri: "backsite/demand/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.demand.store": { uri: "backsite/demand", methods: ["POST"] },
        "backsite.demand.show": {
            uri: "backsite/demand/{demand}",
            methods: ["GET", "HEAD"],
            parameters: ["demand"],
        },
        "backsite.demand.edit": {
            uri: "backsite/demand/{demand}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["demand"],
        },
        "backsite.demand.update": {
            uri: "backsite/demand/{demand}",
            methods: ["PUT", "PATCH"],
            parameters: ["demand"],
            bindings: { demand: "id" },
        },
        "backsite.demand.destroy": {
            uri: "backsite/demand/{demand}",
            methods: ["DELETE"],
            parameters: ["demand"],
        },
        "backsite.atk.index": { uri: "backsite/atk", methods: ["GET", "HEAD"] },
        "backsite.atk.create": {
            uri: "backsite/atk/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.atk.store": { uri: "backsite/atk", methods: ["POST"] },
        "backsite.atk.show": {
            uri: "backsite/atk/{atk}",
            methods: ["GET", "HEAD"],
            parameters: ["atk"],
        },
        "backsite.atk.edit": {
            uri: "backsite/atk/{atk}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["atk"],
        },
        "backsite.atk.update": {
            uri: "backsite/atk/{atk}",
            methods: ["PUT", "PATCH"],
            parameters: ["atk"],
            bindings: { atk: "id" },
        },
        "backsite.atk.destroy": {
            uri: "backsite/atk/{atk}",
            methods: ["DELETE"],
            parameters: ["atk"],
        },
        "backsite.letter.index": {
            uri: "backsite/letter",
            methods: ["GET", "HEAD"],
        },
        "backsite.letter.create": {
            uri: "backsite/letter/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.letter.store": { uri: "backsite/letter", methods: ["POST"] },
        "backsite.letter.show": {
            uri: "backsite/letter/{letter}",
            methods: ["GET", "HEAD"],
            parameters: ["letter"],
        },
        "backsite.letter.edit": {
            uri: "backsite/letter/{letter}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["letter"],
            bindings: { letter: "id" },
        },
        "backsite.letter.update": {
            uri: "backsite/letter/{letter}",
            methods: ["PUT", "PATCH"],
            parameters: ["letter"],
            bindings: { letter: "id" },
        },
        "backsite.letter.destroy": {
            uri: "backsite/letter/{letter}",
            methods: ["DELETE"],
            parameters: ["letter"],
        },
        "backsite.barang.index": {
            uri: "backsite/barang",
            methods: ["GET", "HEAD"],
        },
        "backsite.barang.create": {
            uri: "backsite/barang/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.barang.store": { uri: "backsite/barang", methods: ["POST"] },
        "backsite.barang.show": {
            uri: "backsite/barang/{barang}",
            methods: ["GET", "HEAD"],
            parameters: ["barang"],
        },
        "backsite.barang.edit": {
            uri: "backsite/barang/{barang}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["barang"],
            bindings: { barang: "id" },
        },
        "backsite.barang.update": {
            uri: "backsite/barang/{barang}",
            methods: ["PUT", "PATCH"],
            parameters: ["barang"],
            bindings: { barang: "id" },
        },
        "backsite.barang.destroy": {
            uri: "backsite/barang/{barang}",
            methods: ["DELETE"],
            parameters: ["barang"],
        },
        "backsite.barang.form_processor": {
            uri: "backsite/barang/form_processor",
            methods: ["POST"],
        },
        "backsite.barang.upload_processor": {
            uri: "backsite/barang/upload_processor",
            methods: ["POST"],
        },
        "backsite.barang.show_processor": {
            uri: "backsite/barang/show_processor",
            methods: ["POST"],
        },
        "backsite.barang.delete_processor": {
            uri: "backsite/barang/{id}/delete_processor",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.barang.form_ram": {
            uri: "backsite/barang/form_ram",
            methods: ["POST"],
        },
        "backsite.barang.upload_ram": {
            uri: "backsite/barang/upload_ram",
            methods: ["POST"],
        },
        "backsite.barang.show_ram": {
            uri: "backsite/barang/show_ram",
            methods: ["POST"],
        },
        "backsite.barang.delete_ram": {
            uri: "backsite/barang/{id}/delete_ram",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.barang.form_hardisk": {
            uri: "backsite/barang/form_hardisk",
            methods: ["POST"],
        },
        "backsite.barang.upload_hardisk": {
            uri: "backsite/barang/upload_hardisk",
            methods: ["POST"],
        },
        "backsite.barang.show_hardisk": {
            uri: "backsite/barang/show_hardisk",
            methods: ["POST"],
        },
        "backsite.barang.delete_hardisk": {
            uri: "backsite/barang/{id}/delete_hardisk",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.barang.form_upload_file": {
            uri: "backsite/barang/form_upload",
            methods: ["POST"],
        },
        "backsite.barang.upload_file": {
            uri: "backsite/barang/upload",
            methods: ["POST"],
        },
        "backsite.barang.show_file": {
            uri: "backsite/barang/show_file",
            methods: ["POST"],
        },
        "backsite.barang.delete_file": {
            uri: "backsite/barang/{id}/delete_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.attendance.index": {
            uri: "backsite/attendance",
            methods: ["GET", "HEAD"],
        },
        "backsite.attendance.create": {
            uri: "backsite/attendance/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.attendance.store": {
            uri: "backsite/attendance",
            methods: ["POST"],
        },
        "backsite.attendance.show": {
            uri: "backsite/attendance/{attendance}",
            methods: ["GET", "HEAD"],
            parameters: ["attendance"],
        },
        "backsite.attendance.edit": {
            uri: "backsite/attendance/{attendance}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["attendance"],
        },
        "backsite.attendance.update": {
            uri: "backsite/attendance/{attendance}",
            methods: ["PUT", "PATCH"],
            parameters: ["attendance"],
            bindings: { attendance: "id" },
        },
        "backsite.attendance.destroy": {
            uri: "backsite/attendance/{attendance}",
            methods: ["DELETE"],
            parameters: ["attendance"],
        },
        "backsite.form.index": {
            uri: "backsite/form",
            methods: ["GET", "HEAD"],
        },
        "backsite.form.create": {
            uri: "backsite/form/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.form.store": { uri: "backsite/form", methods: ["POST"] },
        "backsite.form.show": {
            uri: "backsite/form/{form}",
            methods: ["GET", "HEAD"],
            parameters: ["form"],
        },
        "backsite.form.edit": {
            uri: "backsite/form/{form}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["form"],
        },
        "backsite.form.update": {
            uri: "backsite/form/{form}",
            methods: ["PUT", "PATCH"],
            parameters: ["form"],
            bindings: { form: "id" },
        },
        "backsite.form.destroy": {
            uri: "backsite/form/{form}",
            methods: ["DELETE"],
            parameters: ["form"],
        },
        "backsite.form_ti.index": {
            uri: "backsite/form_ti",
            methods: ["GET", "HEAD"],
        },
        "backsite.form_ti.create": {
            uri: "backsite/form_ti/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.form_ti.store": {
            uri: "backsite/form_ti",
            methods: ["POST"],
        },
        "backsite.form_ti.show": {
            uri: "backsite/form_ti/{form_ti}",
            methods: ["GET", "HEAD"],
            parameters: ["form_ti"],
        },
        "backsite.form_ti.edit": {
            uri: "backsite/form_ti/{form_ti}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["form_ti"],
        },
        "backsite.form_ti.update": {
            uri: "backsite/form_ti/{form_ti}",
            methods: ["PUT", "PATCH"],
            parameters: ["form_ti"],
            bindings: { form_ti: "id" },
        },
        "backsite.form_ti.destroy": {
            uri: "backsite/form_ti/{form_ti}",
            methods: ["DELETE"],
            parameters: ["form_ti"],
        },
        "backsite.form_ti.form_upload": {
            uri: "backsite/form_ti/form_upload",
            methods: ["POST"],
        },
        "backsite.form_ti.upload": {
            uri: "backsite/form_ti/upload",
            methods: ["POST"],
        },
        "backsite.form_ti.show_file": {
            uri: "backsite/form_ti/show_file",
            methods: ["POST"],
        },
        "backsite.form_ti.hapus_file": {
            uri: "backsite/form_ti/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.lendingfacility.index": {
            uri: "backsite/lendingfacility",
            methods: ["GET", "HEAD"],
        },
        "backsite.lendingfacility.create": {
            uri: "backsite/lendingfacility/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.lendingfacility.store": {
            uri: "backsite/lendingfacility",
            methods: ["POST"],
        },
        "backsite.lendingfacility.show": {
            uri: "backsite/lendingfacility/{lendingfacility}",
            methods: ["GET", "HEAD"],
            parameters: ["lendingfacility"],
        },
        "backsite.lendingfacility.edit": {
            uri: "backsite/lendingfacility/{lendingfacility}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["lendingfacility"],
        },
        "backsite.lendingfacility.update": {
            uri: "backsite/lendingfacility/{lendingfacility}",
            methods: ["PUT", "PATCH"],
            parameters: ["lendingfacility"],
            bindings: { lendingfacility: "id" },
        },
        "backsite.lendingfacility.destroy": {
            uri: "backsite/lendingfacility/{lendingfacility}",
            methods: ["DELETE"],
            parameters: ["lendingfacility"],
        },
        "backsite.lendingfacility.returning_update": {
            uri: "backsite/lendingfacility/returning_update/{lendingfacility}",
            methods: ["PUT"],
            parameters: ["lendingfacility"],
            bindings: { lendingfacility: "id" },
        },
        "backsite.lendingfacility.returning": {
            uri: "backsite/lendingfacility/{id}/returning",
            methods: ["GET", "HEAD"],
            parameters: ["id"],
        },
        "backsite.lendingfacility.form_upload": {
            uri: "backsite/lendingfacility/form_upload",
            methods: ["POST"],
        },
        "backsite.lendingfacility.upload": {
            uri: "backsite/lendingfacility/upload",
            methods: ["POST"],
        },
        "backsite.lendingfacility.show_file": {
            uri: "backsite/lendingfacility/show_file",
            methods: ["POST"],
        },
        "backsite.lendingfacility.hapus_file": {
            uri: "backsite/lendingfacility/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.bill.index": {
            uri: "backsite/bill",
            methods: ["GET", "HEAD"],
        },
        "backsite.bill.create": {
            uri: "backsite/bill/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.bill.store": { uri: "backsite/bill", methods: ["POST"] },
        "backsite.bill.show": {
            uri: "backsite/bill/{bill}",
            methods: ["GET", "HEAD"],
            parameters: ["bill"],
            bindings: { bill: "id" },
        },
        "backsite.bill.edit": {
            uri: "backsite/bill/{bill}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["bill"],
        },
        "backsite.bill.update": {
            uri: "backsite/bill/{bill}",
            methods: ["PUT", "PATCH"],
            parameters: ["bill"],
            bindings: { bill: "id" },
        },
        "backsite.bill.destroy": {
            uri: "backsite/bill/{bill}",
            methods: ["DELETE"],
            parameters: ["bill"],
            bindings: { bill: "id" },
        },
        "backsite.bill.create_bill": {
            uri: "backsite/bill/{id}/create_bill",
            methods: ["GET", "HEAD"],
            parameters: ["id"],
        },
        "backsite.bill.store_bill": {
            uri: "backsite/bill/store_bill",
            methods: ["POST"],
        },
        "backsite.bill.form_upload": {
            uri: "backsite/bill/form_upload",
            methods: ["POST"],
        },
        "backsite.bill.upload": {
            uri: "backsite/bill/upload",
            methods: ["POST"],
        },
        "backsite.bill.show_file": {
            uri: "backsite/bill/show_file",
            methods: ["POST"],
        },
        "backsite.bill.hapus_file": {
            uri: "backsite/bill/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.pp.index": { uri: "backsite/pp", methods: ["GET", "HEAD"] },
        "backsite.pp.create": {
            uri: "backsite/pp/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.pp.store": { uri: "backsite/pp", methods: ["POST"] },
        "backsite.pp.show": {
            uri: "backsite/pp/{pp}",
            methods: ["GET", "HEAD"],
            parameters: ["pp"],
        },
        "backsite.pp.edit": {
            uri: "backsite/pp/{pp}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["pp"],
        },
        "backsite.pp.update": {
            uri: "backsite/pp/{pp}",
            methods: ["PUT", "PATCH"],
            parameters: ["pp"],
            bindings: { pp: "id" },
        },
        "backsite.pp.destroy": {
            uri: "backsite/pp/{pp}",
            methods: ["DELETE"],
            parameters: ["pp"],
        },
        "backsite.pp.form_upload": {
            uri: "backsite/pp/form_upload",
            methods: ["POST"],
        },
        "backsite.pp.upload": { uri: "backsite/pp/upload", methods: ["POST"] },
        "backsite.pp.show_file": {
            uri: "backsite/pp/show_file",
            methods: ["POST"],
        },
        "backsite.pp.hapus_file": {
            uri: "backsite/pp/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.license.index": {
            uri: "backsite/license",
            methods: ["GET", "HEAD"],
        },
        "backsite.license.create": {
            uri: "backsite/license/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.license.store": {
            uri: "backsite/license",
            methods: ["POST"],
        },
        "backsite.license.show": {
            uri: "backsite/license/{license}",
            methods: ["GET", "HEAD"],
            parameters: ["license"],
        },
        "backsite.license.edit": {
            uri: "backsite/license/{license}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["license"],
        },
        "backsite.license.update": {
            uri: "backsite/license/{license}",
            methods: ["PUT", "PATCH"],
            parameters: ["license"],
            bindings: { license: "id" },
        },
        "backsite.license.destroy": {
            uri: "backsite/license/{license}",
            methods: ["DELETE"],
            parameters: ["license"],
        },
        "backsite.license.form_upload": {
            uri: "backsite/license/form_upload",
            methods: ["POST"],
        },
        "backsite.license.upload": {
            uri: "backsite/license/upload",
            methods: ["POST"],
        },
        "backsite.license.show_file": {
            uri: "backsite/license/show_file",
            methods: ["POST"],
        },
        "backsite.license.delete_file": {
            uri: "backsite/license/{id}/delete_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.drc.index": { uri: "backsite/drc", methods: ["GET", "HEAD"] },
        "backsite.drc.create": {
            uri: "backsite/drc/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.drc.store": { uri: "backsite/drc", methods: ["POST"] },
        "backsite.drc.show": {
            uri: "backsite/drc/{drc}",
            methods: ["GET", "HEAD"],
            parameters: ["drc"],
        },
        "backsite.drc.edit": {
            uri: "backsite/drc/{drc}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["drc"],
            bindings: { drc: "id" },
        },
        "backsite.drc.update": {
            uri: "backsite/drc/{drc}",
            methods: ["PUT", "PATCH"],
            parameters: ["drc"],
            bindings: { drc: "id" },
        },
        "backsite.drc.destroy": {
            uri: "backsite/drc/{drc}",
            methods: ["DELETE"],
            parameters: ["drc"],
        },
        "backsite.drc-monitoring.index": {
            uri: "backsite/drc-monitoring",
            methods: ["GET", "HEAD"],
        },
        "backsite.drc-monitoring.create": {
            uri: "backsite/drc-monitoring/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.drc-monitoring.store": {
            uri: "backsite/drc-monitoring",
            methods: ["POST"],
        },
        "backsite.drc-monitoring.show": {
            uri: "backsite/drc-monitoring/{drc_monitoring}",
            methods: ["GET", "HEAD"],
            parameters: ["drc_monitoring"],
        },
        "backsite.drc-monitoring.edit": {
            uri: "backsite/drc-monitoring/{drc_monitoring}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["drc_monitoring"],
        },
        "backsite.drc-monitoring.update": {
            uri: "backsite/drc-monitoring/{drc_monitoring}",
            methods: ["PUT", "PATCH"],
            parameters: ["drc_monitoring"],
        },
        "backsite.drc-monitoring.destroy": {
            uri: "backsite/drc-monitoring/{drc_monitoring}",
            methods: ["DELETE"],
            parameters: ["drc_monitoring"],
        },
        "backsite.application-monitoring.index": {
            uri: "backsite/application-monitoring",
            methods: ["GET", "HEAD"],
        },
        "backsite.application-monitoring.create": {
            uri: "backsite/application-monitoring/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.application-monitoring.store": {
            uri: "backsite/application-monitoring",
            methods: ["POST"],
        },
        "backsite.application-monitoring.show": {
            uri: "backsite/application-monitoring/{application_monitoring}",
            methods: ["GET", "HEAD"],
            parameters: ["application_monitoring"],
        },
        "backsite.application-monitoring.edit": {
            uri: "backsite/application-monitoring/{application_monitoring}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["application_monitoring"],
        },
        "backsite.application-monitoring.update": {
            uri: "backsite/application-monitoring/{application_monitoring}",
            methods: ["PUT", "PATCH"],
            parameters: ["application_monitoring"],
        },
        "backsite.application-monitoring.destroy": {
            uri: "backsite/application-monitoring/{application_monitoring}",
            methods: ["DELETE"],
            parameters: ["application_monitoring"],
        },
        "backsite.tpt.index": { uri: "backsite/tpt", methods: ["GET", "HEAD"] },
        "backsite.tpt.create": {
            uri: "backsite/tpt/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.tpt.store": { uri: "backsite/tpt", methods: ["POST"] },
        "backsite.tpt.show": {
            uri: "backsite/tpt/{tpt}",
            methods: ["GET", "HEAD"],
            parameters: ["tpt"],
        },
        "backsite.tpt.edit": {
            uri: "backsite/tpt/{tpt}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["tpt"],
            bindings: { tpt: "id" },
        },
        "backsite.tpt.update": {
            uri: "backsite/tpt/{tpt}",
            methods: ["PUT", "PATCH"],
            parameters: ["tpt"],
            bindings: { tpt: "id" },
        },
        "backsite.tpt.destroy": {
            uri: "backsite/tpt/{tpt}",
            methods: ["DELETE"],
            parameters: ["tpt"],
        },
        "backsite.antivirus.index": {
            uri: "backsite/antivirus",
            methods: ["GET", "HEAD"],
        },
        "backsite.antivirus.create": {
            uri: "backsite/antivirus/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.antivirus.store": {
            uri: "backsite/antivirus",
            methods: ["POST"],
        },
        "backsite.antivirus.show": {
            uri: "backsite/antivirus/{antiviru}",
            methods: ["GET", "HEAD"],
            parameters: ["antiviru"],
        },
        "backsite.antivirus.edit": {
            uri: "backsite/antivirus/{antiviru}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["antiviru"],
        },
        "backsite.antivirus.update": {
            uri: "backsite/antivirus/{antiviru}",
            methods: ["PUT", "PATCH"],
            parameters: ["antiviru"],
        },
        "backsite.antivirus.destroy": {
            uri: "backsite/antivirus/{antiviru}",
            methods: ["DELETE"],
            parameters: ["antiviru"],
        },
        "backsite.antivirus.form_upload": {
            uri: "backsite/antivirus/form_upload",
            methods: ["POST"],
        },
        "backsite.antivirus.upload": {
            uri: "backsite/antivirus/upload",
            methods: ["POST"],
        },
        "backsite.antivirus.show_file": {
            uri: "backsite/antivirus/show_file",
            methods: ["POST"],
        },
        "backsite.antivirus.delete_file": {
            uri: "backsite/antivirus/{id}/delete_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.distribution.index": {
            uri: "backsite/distribution",
            methods: ["GET", "HEAD"],
        },
        "backsite.distribution.create": {
            uri: "backsite/distribution/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.distribution.store": {
            uri: "backsite/distribution",
            methods: ["POST"],
        },
        "backsite.distribution.show": {
            uri: "backsite/distribution/{distribution}",
            methods: ["GET", "HEAD"],
            parameters: ["distribution"],
        },
        "backsite.distribution.edit": {
            uri: "backsite/distribution/{distribution}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["distribution"],
        },
        "backsite.distribution.update": {
            uri: "backsite/distribution/{distribution}",
            methods: ["PUT", "PATCH"],
            parameters: ["distribution"],
            bindings: { distribution: "id" },
        },
        "backsite.distribution.destroy": {
            uri: "backsite/distribution/{distribution}",
            methods: ["DELETE"],
            parameters: ["distribution"],
        },
        "backsite.distribution.form_upload": {
            uri: "backsite/distribution/form_upload",
            methods: ["POST"],
        },
        "backsite.distribution.upload_file": {
            uri: "backsite/distribution/upload_file",
            methods: ["POST"],
        },
        "backsite.distribution.show_file": {
            uri: "backsite/distribution/show_file",
            methods: ["POST"],
        },
        "backsite.distribution.delete_file": {
            uri: "backsite/distribution/{id}/delete_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.distribution.destroy_asset": {
            uri: "backsite/distribution/{id}/destroy_asset",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.application.index": {
            uri: "backsite/application",
            methods: ["GET", "HEAD"],
        },
        "backsite.application.create": {
            uri: "backsite/application/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.application.store": {
            uri: "backsite/application",
            methods: ["POST"],
        },
        "backsite.application.show": {
            uri: "backsite/application/{application}",
            methods: ["GET", "HEAD"],
            parameters: ["application"],
        },
        "backsite.application.edit": {
            uri: "backsite/application/{application}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["application"],
        },
        "backsite.application.update": {
            uri: "backsite/application/{application}",
            methods: ["PUT", "PATCH"],
            parameters: ["application"],
            bindings: { application: "id" },
        },
        "backsite.application.destroy": {
            uri: "backsite/application/{application}",
            methods: ["DELETE"],
            parameters: ["application"],
        },
        "backsite.application.form_upload_note": {
            uri: "backsite/application/form_upload_note",
            methods: ["POST"],
        },
        "backsite.application.upload_note": {
            uri: "backsite/application/upload_note",
            methods: ["POST"],
        },
        "backsite.application.show_file_note": {
            uri: "backsite/application/show_file_note",
            methods: ["POST"],
        },
        "backsite.application.delete_file_note": {
            uri: "backsite/application/{id}/delete_file_note",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.application.form_upload_file": {
            uri: "backsite/application/form_upload",
            methods: ["POST"],
        },
        "backsite.application.upload_file": {
            uri: "backsite/application/upload",
            methods: ["POST"],
        },
        "backsite.application.show_file": {
            uri: "backsite/application/show_file",
            methods: ["POST"],
        },
        "backsite.application.delete_file": {
            uri: "backsite/application/{id}/delete_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.act_daily.index": {
            uri: "backsite/act_daily",
            methods: ["GET", "HEAD"],
        },
        "backsite.act_daily.create": {
            uri: "backsite/act_daily/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.act_daily.store": {
            uri: "backsite/act_daily",
            methods: ["POST"],
        },
        "backsite.act_daily.show": {
            uri: "backsite/act_daily/{act_daily}",
            methods: ["GET", "HEAD"],
            parameters: ["act_daily"],
        },
        "backsite.act_daily.edit": {
            uri: "backsite/act_daily/{act_daily}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["act_daily"],
        },
        "backsite.act_daily.update": {
            uri: "backsite/act_daily/{act_daily}",
            methods: ["PUT", "PATCH"],
            parameters: ["act_daily"],
        },
        "backsite.act_daily.destroy": {
            uri: "backsite/act_daily/{act_daily}",
            methods: ["DELETE"],
            parameters: ["act_daily"],
        },
        "backsite.act_daily.form_upload": {
            uri: "backsite/act_daily/form_upload",
            methods: ["POST"],
        },
        "backsite.act_daily.upload": {
            uri: "backsite/act_daily/upload",
            methods: ["POST"],
        },
        "backsite.act_daily.show_file": {
            uri: "backsite/act_daily/show_file",
            methods: ["POST"],
        },
        "backsite.act_daily.hapus_file": {
            uri: "backsite/act_daily/{id}/hapus_file",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "backsite.workcat.index": {
            uri: "backsite/workcat",
            methods: ["GET", "HEAD"],
        },
        "backsite.workcat.create": {
            uri: "backsite/workcat/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.workcat.store": {
            uri: "backsite/workcat",
            methods: ["POST"],
        },
        "backsite.workcat.show": {
            uri: "backsite/workcat/{workcat}",
            methods: ["GET", "HEAD"],
            parameters: ["workcat"],
            bindings: { workcat: "id" },
        },
        "backsite.workcat.edit": {
            uri: "backsite/workcat/{workcat}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["workcat"],
        },
        "backsite.workcat.update": {
            uri: "backsite/workcat/{workcat}",
            methods: ["PUT", "PATCH"],
            parameters: ["workcat"],
            bindings: { workcat: "id" },
        },
        "backsite.workcat.destroy": {
            uri: "backsite/workcat/{workcat}",
            methods: ["DELETE"],
            parameters: ["workcat"],
        },
        "backsite.ip_phone.index": {
            uri: "backsite/ip_phone",
            methods: ["GET", "HEAD"],
        },
        "backsite.ip_phone.create": {
            uri: "backsite/ip_phone/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.ip_phone.store": {
            uri: "backsite/ip_phone",
            methods: ["POST"],
        },
        "backsite.ip_phone.show": {
            uri: "backsite/ip_phone/{ip_phone}",
            methods: ["GET", "HEAD"],
            parameters: ["ip_phone"],
        },
        "backsite.ip_phone.edit": {
            uri: "backsite/ip_phone/{ip_phone}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["ip_phone"],
        },
        "backsite.ip_phone.update": {
            uri: "backsite/ip_phone/{ip_phone}",
            methods: ["PUT", "PATCH"],
            parameters: ["ip_phone"],
            bindings: { ip_phone: "id" },
        },
        "backsite.ip_phone.destroy": {
            uri: "backsite/ip_phone/{ip_phone}",
            methods: ["DELETE"],
            parameters: ["ip_phone"],
        },
        "backsite.cctv.index": {
            uri: "backsite/cctv",
            methods: ["GET", "HEAD"],
        },
        "backsite.cctv.create": {
            uri: "backsite/cctv/create",
            methods: ["GET", "HEAD"],
        },
        "backsite.cctv.store": { uri: "backsite/cctv", methods: ["POST"] },
        "backsite.cctv.show": {
            uri: "backsite/cctv/{cctv}",
            methods: ["GET", "HEAD"],
            parameters: ["cctv"],
        },
        "backsite.cctv.edit": {
            uri: "backsite/cctv/{cctv}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["cctv"],
        },
        "backsite.cctv.update": {
            uri: "backsite/cctv/{cctv}",
            methods: ["PUT", "PATCH"],
            parameters: ["cctv"],
            bindings: { cctv: "id" },
        },
        "backsite.cctv.destroy": {
            uri: "backsite/cctv/{cctv}",
            methods: ["DELETE"],
            parameters: ["cctv"],
        },
    },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
