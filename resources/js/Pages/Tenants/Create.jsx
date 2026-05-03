import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        phone: '',
        address: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/tenants');
    };

    const inputStyle = {
        width: '100%',
        padding: '10px 12px',
        border: '1px solid #cbd5e1',
        borderRadius: '8px',
        fontSize: '14px',
        marginTop: '6px',
        boxSizing: 'border-box',
    };

    const errorStyle = { color: '#ef4444', fontSize: '12px', marginTop: '4px' };

    return (
        <AuthenticatedLayout header="🏫 Add School">
            <Head title="Add School" />

            <div style={{ maxWidth: '560px', background: '#fff', borderRadius: '10px', padding: '24px', boxShadow: '0 1px 4px rgba(0,0,0,0.08)' }}>
                <form onSubmit={handleSubmit}>

                    {/* Name */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>School Name *</label>
                        <input
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            style={inputStyle}
                            placeholder="Enter school name"
                        />
                        {errors.name && <p style={errorStyle}>{errors.name}</p>}
                    </div>

                    {/* Email */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Email *</label>
                        <input
                            type="email"
                            value={data.email}
                            onChange={e => setData('email', e.target.value)}
                            style={inputStyle}
                            placeholder="Enter email"
                        />
                        {errors.email && <p style={errorStyle}>{errors.email}</p>}
                    </div>

                    {/* Phone */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Phone</label>
                        <input
                            type="text"
                            value={data.phone}
                            onChange={e => setData('phone', e.target.value)}
                            style={inputStyle}
                            placeholder="Enter phone number"
                        />
                        {errors.phone && <p style={errorStyle}>{errors.phone}</p>}
                    </div>

                    {/* Address */}
                    <div style={{ marginBottom: '24px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Address</label>
                        <textarea
                            value={data.address}
                            onChange={e => setData('address', e.target.value)}
                            style={{ ...inputStyle, height: '80px', resize: 'vertical' }}
                            placeholder="Enter school address"
                        />
                        {errors.address && <p style={errorStyle}>{errors.address}</p>}
                    </div>

                    {/* Buttons */}
                    <div style={{ display: 'flex', gap: '12px' }}>
                        <button
                            type="submit"
                            disabled={processing}
                            style={{
                                background: '#3b82f6',
                                color: '#fff',
                                padding: '10px 24px',
                                borderRadius: '8px',
                                border: 'none',
                                cursor: 'pointer',
                                fontSize: '14px',
                                opacity: processing ? 0.7 : 1,
                            }}
                        >
                            {processing ? 'Saving...' : 'Save School'}
                        </button>
                        <Link
                            href="/tenants"
                            style={{
                                background: '#e2e8f0',
                                color: '#475569',
                                padding: '10px 24px',
                                borderRadius: '8px',
                                textDecoration: 'none',
                                fontSize: '14px',
                            }}
                        >
                            Cancel
                        </Link>
                    </div>

                </form>
            </div>
        </AuthenticatedLayout>
    );
}