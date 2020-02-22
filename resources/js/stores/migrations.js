import Vue from 'vue';
import api from '../api';
import Migration from '../models/Migration';
import errors from './errors';
import toasts from './toasts';

export default new Vue({
    data() {
        return {
            connection: null,
            database: null,
            loading: false,
            migrationDetails: {},
            migrationNames: [],
            queue: [],
            queueRunning: false,
            running: false,
            tables: [],
        };
    },
    computed: {
        allMigrations() {
            return this.migrationNames.map(name => this.migrationDetails[name]);
        },
    },
    methods: {
        async load() {
            this.loading = true;

            try {
                const response = await api.get('list');
                this.setOverview(response.data);
            } finally {
                this.loading = false;
            }
        },
        getMigration(name) {
            if (!(name in this.migrationDetails)) {
                Vue.set(this.migrationDetails, name, new Migration(name));
            }

            return this.migrationDetails[name];
        },
        async fresh(seed) {
            this.running = true;

            try {
                const response = await api.post('fresh', { seed });
                this.setOverview(response.data);
            } finally {
                this.running = false;
            }
        },
        async loadDetails(name) {
            const migration = this.getMigration(name);

            migration.loading = true;

            try {
                const response = await api.get(`migration-details/${name}`);
                migration.fill(response.data);
            } finally {
                migration.loading = false;
            }
        },
        async refresh(seed) {
            this.running = true;

            try {
                const response = await api.post('refresh', { seed });
                this.setOverview(response.data);
            } finally {
                this.running = false;
            }
        },
        async seed() {
            this.running = true;

            try {
                const response = await api.post('seed');
                this.setOverview(response.data);
            } finally {
                this.running = false;
            }
        },
        async migrateAll() {
            const migrations = this.allMigrations.filter(migration => !migration.isApplied);

            migrations.forEach(migration => migration.running = true);

            try {
                const response = await api.post('migrate-all');
                this.setOverview(response.data);
            } finally {
                migrations.forEach(migration => migration.running = false);
            }
        },
        async migrateSingle(migration) {
            migration.running = true;

            try {
                const response = await api.post(`migrate-single/${migration.name}`);
                this.setOverview(response.data);
            } finally {
                migration.running = false;
            }
        },
        async rollbackAll() {
            const migrations = this.allMigrations.filter(migration => migration.isApplied);

            migrations.forEach(migration => migration.running = true);

            try {
                const response = await api.post('rollback-all');
                this.setOverview(response.data);
            } finally {
                migrations.forEach(migration => migration.running = false);
            }
        },
        async rollbackBatch(batch) {
            const migrations = this.allMigrations.filter(migration => migration.batch === batch);

            migrations.forEach(migration => migration.running = true);

            try {
                const response = await api.post(`rollback-batch/${batch}`);
                this.setOverview(response.data);
            } finally {
                migrations.forEach(migration => migration.running = false);
            }
        },
        async rollbackSingle(migration) {
            migration.running = true;

            try {
                const response = await api.post(`rollback-single/${migration.name}`);
                this.setOverview(response.data);
            } finally {
                migration.running = false;
            }
        },
        setOverview(data) {
            this.connection = data.connection;
            this.database = data.database;
            this.tables = data.tables;

            // Split the migrations list into a list of names and a map of details
            let migrationNames = [];

            for (let migration of data.migrations) {
                migrationNames.push(migration.name);
                this.getMigration(migration.name).fill(migration);
            }

            this.migrationNames = migrationNames;

            // Display any toast messages attached to the data
            if (data.toasts) {
                toasts.show(data.toasts);
            }

            // If it failed, show the error message
            if (data.error) {
                errors.show(data.error.title, data.error.html);
            }
        },
    },
});
