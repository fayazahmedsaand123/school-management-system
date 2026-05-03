import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Edit({ student }) {
    const { data, setData, put, processing, errors } = useForm({
        name:  student.name,
        email: student.email,
        phone: student.phone ?? '',
        dob:   student.dob ?? '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put(`/students/${student.id}`);
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
        <AuthenticatedLayout header="✏️ Edit Student">
            <Head title="Edit Student" />

            <div style={{ maxWidth: '560px', background: '#fff', borderRadius: '10px', padding: '24px', boxShadow: '0 1px 4px rgba(0,0,0,0.08)' }}>
                <form onSubmit={handleSubmit}>

                    {/* Name */}
                    <div style={{ marginBottom: '16px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Name *</label>
                        <input
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            style={inputStyle}
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
                        />
                        {errors.phone && <p style={errorStyle}>{errors.phone}</p>}
                    </div>

                    {/* Date of Birth */}
                    <div style={{ marginBottom: '24px' }}>
                        <label style={{ fontSize: '14px', color: '#475569' }}>Date of Birth</label>
                        <input
                            type="date"
                            value={data.dob}
                            onChange={e => setData('dob', e.target.value)}
                            style={inputStyle}
                        />
                        {errors.dob && <p style={errorStyle}>{errors.dob}</p>}
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
                            {processing ? 'Updating...' : 'Update Student'}
                        </button>
                        <Link
                            href="/students"
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