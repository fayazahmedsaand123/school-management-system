import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Edit({ auth, teacher }) {
    const { data, setData, put, processing, errors } = useForm({
        name:    teacher.name,
        email:   teacher.email,
        phone:   teacher.phone ?? '',
        subject: teacher.subject ?? '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put(`/teachers/${teacher.id}`);
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
        <AuthenticatedLayout 
            auth={auth} 
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">✏️ Edit Teacher</h2>}
        >
            <Head title="Edit Teacher" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                            {/* Subject */}
                            <div style={{ marginBottom: '24px' }}>
                                <label style={{ fontSize: '14px', color: '#475569' }}>Subject</label>
                                <input
                                    type="text"
                                    value={data.subject}
                                    onChange={e => setData('subject', e.target.value)}
                                    style={inputStyle}
                                />
                                {errors.subject && <p style={errorStyle}>{errors.subject}</p>}
                            </div>

                            {/* Buttons */}
                            <div style={{ display: 'flex', gap: '12px', alignItems: 'center' }}>
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
                                        opacity: processing ? 0.7 : 1
                                    }}
                                >
                                    {processing ? 'Updating...' : 'Update Teacher'}
                                </button>
                                
                                <Link
                                    href="/teachers"
                                    style={{
                                        background: '#e2e8f0',
                                        color: '#475569',
                                        padding: '10px 24px',
                                        borderRadius: '8px',
                                        textDecoration: 'none',
                                        fontSize: '14px',
                                        display: 'inline-block'
                                    }}
                                >
                                    Cancel
                                </Link>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}