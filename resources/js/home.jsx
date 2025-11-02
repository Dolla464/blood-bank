import React from "react";
import { createRoot } from "react-dom/client";

function Home({ user }) {
    const handleLogout = () => {
        // Create a form to submit logout request
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/logout";

        // Add CSRF token
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");
        if (csrfToken) {
            const csrfInput = document.createElement("input");
            csrfInput.type = "hidden";
            csrfInput.name = "_token";
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
        }

        document.body.appendChild(form);
        form.submit();
    };

    return (
        <div style={{ padding: "30px", fontFamily: "sans-serif" }}>
            <div
                style={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                    marginBottom: "20px",
                }}
            >
                <h1>Welcome to BloodBank 🩸</h1>
                {user && (
                    <button
                        onClick={handleLogout}
                        style={{
                            backgroundColor: "#dc3545",
                            color: "white",
                            border: "none",
                            padding: "10px 20px",
                            borderRadius: "5px",
                            cursor: "pointer",
                            fontSize: "14px",
                        }}
                    >
                        Logout
                    </button>
                )}
            </div>
            {user ? (
                <p>Hello, {user.name}! Ready to help save lives today?</p>
            ) : (
                <p>Please log in or register to continue.</p>
            )}
        </div>
    );
}

const el = document.getElementById("home-root");
if (el) {
    let props = {};
    try {
        props = JSON.parse(el.dataset.props || "{}");
    } catch {}
    createRoot(el).render(<Home {...props} />);
}
