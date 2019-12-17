import AppForm from '../app-components/Form/AppForm';

Vue.component('invoice-form', {
    mixins: [AppForm],
    props: {
        items: {
            type: Array,
            default(){
                return []
            }
        },
        accounts: {
            type: Array,
            default(){
                return []
            }
        },
        stocks: {
            type: Array,
            default(){
                return []
            }
        }
    },
    data() {
        return {
            form: {
                system_invoice_no:  '' ,
                billing_invoice_no:  '' ,
                discount:  0 ,
                cash:  0 ,
                invoice_type:  'debit_voucher' ,
                note:  '' ,
                billing_account_id:  '' ,
                project_id:  '' ,
                project: null,
                account: null,
                billing_name: '',
                billing_address: '',
                billing_phone: '',
                billing_email: '',
                invoiceItems: []
            },
        }
    },
    methods: {
        addItem(...items){
            console.log(items);
            if(items.length === 0){
                items.push({
                    sl_no: (this.form.invoiceItems || []).length + 1,
                    stock_id: '',
                    description: '',
                    unit_price: 0,
                    unit_name: 'pcs',
                    quantity: 0,
                    type: '+',
                    amount: 0
                });
            }
            let existingItems = [];
            if(this.form.invoiceItems){
                existingItems = this.form.invoiceItems;
            }
            this.$set(this.form, 'invoiceItems', [...existingItems, ...items]);
        },
        updateAmount(item){
            item.amount = (item.quantity || 0) * (item.unit_price || 0); 
        },
        deleteItem(index, item){
            if(item.id){
                if(!this.form.deletedItems){
                    this.form.deletedItems = [];
                }
                this.form.deletedItems.push(item.id);
            }
            this.form.invoiceItems.splice(index, 1);
            this.form.invoiceItems = this.form.invoiceItems.map((item, index)=>{
                item.sl_no = index + 1;
                return item;
            });
            if(this.form.invoiceItems.length === 0){
                this.addItem();
            }
        },
        accountChanged(account){
            if(!account) account = {}
            this.form.billing_name = account.name;
            this.form.billing_address = account.address;
            this.form.billing_phone = account.phone;
            this.form.billing_email = account.email;
            this.form.billing_account_id = account.id;
        },
        checkSign(item){
            if(['+', '-'].indexOf(item.type.trim()) === -1){
                item.type = '+';
            }
        },
        total(){
            if(!this.form.invoiceItems){
                this.form.invoiceItems = [];
            }
            const tax = -1 * (this.form.tax || 0);
            return this.form.invoiceItems.reduce((total, item)=> {
                if(item.type === '-'){
                    return total - +item.amount;
                } else {
                    return total + +item.amount;
                }
            },tax);
        },
        due(){
            return this.total() - (this.form.cash || 0);
        },
        beforePost(form = {}){
            form.amount = this.total();
            return form;
        }

    },
    watch: {
        items(val){
            val = [...val].map((item, index)=>{
                item.sl_no = index + 1;
                return item;
            });
        }
    },
    created(){
        this.$set(this.form, 'invoiceItems', []);
        this.$set(this.form, 'deletedItems', []);
        if(this.items && this.items.length === 0){
            this.addItem();
        } else if(this.items){
            this.addItem(...this.items);
        }
        const account = this.accounts.find(item=>item.id === this.form.billing_account_id);
        if(account){
            this.form.account = account;
            this.accountChanged(account);
        }
        const d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear(),
            sec = d.getHours() * 3600 + d.getMinutes() * 60 + d.getSeconds();
        if(this.form && !this.form.system_invoice_no){
            this.form.system_invoice_no = `${year}-${month}-${day}-${sec}`
        }
    }

});